<?php

namespace Commands;

use Exception;

abstract class AbstractCommand implements Command
{
    protected ?string $value;
    protected array $argsMap = [];
    protected static ?string $alias = null;

    protected static bool $requiredCommandValue = false;

    /**
     * @throws Exception
     */
    public function __construct(){
        $this->setUpArgsMap();
    }

    /*
     * シェルからすべての引数を読み込み、それをこのクラスのgetArguments()と整列するハッシュマップを作成します。
     * このargsMapは getArgumentValue()のために使用されます。
     * すべての引数は短縮バージョンでは'-'で、完全なバージョンでは'--'で始まります。
     */

    private function setUpArgsMap(): void{
        //オリジナルのマッピングを設定
        $args = $GLOBALS['argv'];
        // エイリアスのインデックスが見つかるまで探索
        $startIndex  = array_search($this->getAlias(), $args);

        if($startIndex === false) throw new Exception(sprintf("Could not find alias %s", $this->getAlias()));
        else $startIndex++;

        $shellArgs = [];

        // debug_memo
        // isset()関数
        // 変数が設定されており、かつ NULL ではないかどうかを確認するために使用されます。
        // これは、変数が存在すること、そしてそれが何らかの値を持っていること（NULL 以外）
        // を検証するのに役立ちます。

        // メインコマンドの値である初期値を取得
        if(!isset($args[$startIndex]) || ($args[$startIndex][0] === '-')){
            // debug_memo
            // 例
            //  "php console migrate" or "php console migrate -*(ハイフンから始まる文字列)"
            // sprintfを出力し終了
            if($this->isCommandValueRequired()) throw new Exception(sprintf("%s's value is required.", $this->getAlias()));
        }
        else{
            // debug_memo
            // 例
            //  php console migrate 9
            // {"migrate":"9"}
            $this->argsMap[$this->getAlias()] = $args[$startIndex];
            $startIndex++;
        }

        // すべての引数を$argsハッシュに格納
        for($i = $startIndex; $i < count($args); $i++){
            $arg = $args[$i];

            if($arg[0].$arg[1] === '--') $key = substr($arg,2);
            else if($arg[0] === '-') $key = substr($arg,1);
            else throw new Exception('Options must start with - or --');

            $shellArgs[$key] = true;

            // if the next args entry is not an option, then it is an argument value. Increment $i as well.
            // 次のargsエントリがオプションでない場合は、引数値となります。iも同様にインクリメントします。
            if(isset($args[$i+1]) && $args[$i+1] !== '-') {
                $shellArgs[$key] = $args[$i+1];
                $i++;
            }
        }

        // このコマンドの引数マップを設定
        foreach ($this->getArguments() as $argument) {
            $argString = $argument->getArgument();
            $value = null;

            if($argument->isShortAllowed() && isset($shellArgs[$argString[0]])) $value = $shellArgs[$argString[0]];
            else if(isset($shellArgs[$argString])) $value = $shellArgs[$argString];

            if($value === null){
                if($argument->isRequired()) throw new Exception(sprintf('Could not find the required argument %s', $argString));
                else $this->argsMap[$argString] = false;
            }
            else $this->argsMap[$argString] = $value;
        }

        $this->log(json_encode($this->argsMap));
    }

    public static function getHelp(): string
    {
        $helpString = "Command: " . static::getAlias() . (static::isCommandValueRequired()?" {value}":"") . PHP_EOL;

        // debug_memo
        // 'code-gen'なら空なのでここでreturnする
        // 'migrate'ならここはスルーする
        $arguments = static::getArguments();
        if(empty($arguments)) return $helpString;

        $helpString .= "Arguments:" . PHP_EOL;

        foreach ($arguments as $argument) {
            $helpString .= "  --" . $argument->getArgument();  // long argument name
            if ($argument->isShortAllowed()) {
                $helpString .= " (-" . $argument->getArgument()[0] . ")";  // short argument name
            }
            $helpString .= ": " . $argument->getDescription();
            $helpString .= $argument->isRequired() ? " (Required)" : "(Optional)";
            $helpString .= PHP_EOL;
        }

        return $helpString;
    }

    public static function getAlias(): string
    {
        // debug_memo
        // $aliasにはCLIで'code-gen'か'migrate'コマンドが書かれるとその文字列を返す
        // それ以外ならクラス名の'AbstractCommand'を返す

        // staticはselfと比べて遅延バインディングを行い、
        // 子クラスが$aliasをオーバーライドするとその値を使用します。
        // selfは常にこのクラスの値($alias = null)を使用します。
        return static::$alias !== null ? static::$alias : static::class;
    }

    public static function isCommandValueRequired(): bool{
        // debug_memo
        // 現状は、'code-gen'をCLIに入力してたら、trueを返す
        return static::$requiredCommandValue;
    }

    // debug_memo
    // getAlias()の戻り値
    // nullでないならgetAlias()を返す
    // nullなら空文字を返す
    public function getCommandValue(): string{
        return $this->argsMap[static::getAlias()]??"";
    }

    // 引数の値の文字列を返し、存在するが値が設定されていない場合はtrue、存在しない場合はfalseを返します。
    public function getArgumentValue(string $arg): bool|string
    {
        return $this->argsMap[$arg];
    }

    // 子コマンドにログを取る方法を提供します。
    protected function log(string $info): void
    {
        fwrite(STDOUT, $info . PHP_EOL);
    }

    /** @return Argument[]  */
    public abstract static function getArguments(): array;
    public abstract function execute(): int;
}