<?php
namespace Database;

use Database\MySQLWrapper;

abstract class AbstractSeeder implements Seeder {
    protected MySQLWrapper $conn;
    protected ?string $tableName = null;

    // テーブルカラムは、'data_type' と 'column_name' を含む連想配列の配列です。
    protected array $tableColumns = [];

    // 使用可能なカラムのタイプです。
    // これらはバリデーションチェックとbind_param()のために使用されます。
    // キーはタイプの文字列で、値はbind_paramの文字列です。
    const AVAILABLE_TYPES = [
        'int' => 'i',
        // PHPのfloatは実際にはdouble型の精度です。
        'float' => 'd',
        'string' => 's',
    ];

    public function __construct(MySQLWrapper $conn) {
        $this->conn = $conn;
    }

    public function seed(string $name, string $syntax, string $expiration, string $url): void {
        $data = $this->createRowData($name, $syntax, $expiration, $url);

        if($this->tableName === null) throw new \Exception('Class requires a table name');
        if(empty($this->tableColumns)) throw new \Exception('Class requires a columns');

        foreach ($data as $row) {
            // 行を検証し、問題がなければ行を挿入します。
            $this->validateRow($row);
            $this->insertRow($row);
        }
    }

    // 各行をtableColumnsと照らし合わせて検証します。
    protected function validateRow(array $row): void {
        if(count($row) !== count($this->tableColumns)) throw new \Exception('Row does not match the ');

        foreach ($row as $i=>$value) {
            $columnDataType = $this->tableColumns[$i]['data_type'];
            $columnName = $this->tableColumns[$i]['column_name'];

            if(!isset(static::AVAILABLE_TYPES[$columnDataType])) throw new \InvalidArgumentException(sprintf("The data type %s is not an available data type.", $columnDataType));

            // PHPは、値のデータタイプを返すget_debug_type()関数とgettype()関数の両方を提供しています。
            // クラス名でも機能します。
            // https://www.php.net/manual/en/function.get-debug-type.php を参照してください。
            // get_debug_typeはネイティブのPHP 8タイプを返します。
            // 例えば、floatsのgettype、gettype(4.5)は、ネイティブのデータタイプ'float'ではなく文字列'double'を返します。
            if (get_debug_type($value) !== $columnDataType) throw new \InvalidArgumentException(sprintf("Value for %s should be of type %s. Here is the current value: %s", $columnName, $columnDataType, json_encode($value)));
        }
    }

    // 各行をテーブルに挿入します。
    // $tableColumnsはデータタイプとカラム名を取得するために使用されます。
    protected function insertRow(array $row): void {
        // カラム名を取得します。
        $columnNames = array_map(function($columnInfo){ return $columnInfo['column_name'];}, $this->tableColumns);

        // クエリを準備する際、count($row)のプレースホルダー '?' があります。
        // bind_param関数はこれらにデータを挿入します。
        $placeholders = str_repeat('?,', count($row) - 1) . '?';

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->tableName,
            implode(', ', $columnNames),
            $placeholders
        );

        $stmt = $this->conn->prepare($sql);

        // implodeは配列を一つの文字列に結合し、その文字列を返します。
        $dataTypes = implode(array_map(function($columnInfo){ return static::AVAILABLE_TYPES[$columnInfo['data_type']];}, $this->tableColumns));

        // bind paramsは文字の配列（文字列）を取り、それぞれに値を挿入します。
        // 例：$stmt->bind_param('iss', ...array_values([1, 'John', 'john@example.com'])) は、ステートメントに整数、文字列、文字列を挿入します。
        $stmt->bind_param($dataTypes, ...array_values($row));

        $stmt->execute();
    }
}