require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs" }});
require(["vs/editor/editor.main"], function() {
    const editor = monaco.editor.create(document.getElementById("editor"), {
        value: JSON.parse('"' + snippet["code"] + '"'),
        language: snippet["syntax"],
        readOnly: true
    });

    // copyボタンをクリックするとmonaco-editorのスニペットを全選択してコピーする
    document.getElementById("copy_button").addEventListener('click', function() {
        editor.updateOptions({ readOnly: false });
        const range = editor.getModel().getFullModelRange();
        editor.setSelection(range);
        editor.trigger('source','editor.action.clipboardCopyAction');
        editor.setPosition({ lineNumber: 1, column: 1 });
        editor.updateOptions({ readOnly: true });
        document.getElementById("copy_message").innerHTML = "Copy complete!!!"
    });
});
