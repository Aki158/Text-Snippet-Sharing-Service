require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs" }});
require(["vs/editor/editor.main"], function() {
    window.editor = monaco.editor.create(document.getElementById("editor"), {
        value: "",
        language: "plaintext"
    });
});

