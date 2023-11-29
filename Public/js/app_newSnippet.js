require.config({ paths: { "vs": "https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs" }});
require(["vs/editor/editor.main"], function() {
    const editor = monaco.editor.create(document.getElementById("editor"), {
        value: "",
        language: "plaintext"
    });

    function debounce(func, wait) {
        var timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const updateToFile = () => {
            const hashmap = {
                    data : editor.getValue(),
                    file_name : "edit",
                    file_type : "txt"
                }
            
            fetch("generateToFile.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(hashmap)
            })
            .then(response => response.text())
            .then(data => {
                // PHPからの戻り値を確認可能だが、今回は設定しない
            })
            .catch(error => {
                console.error("Error:", error);
        });
    };

    // エディタの変更を監視し、debounce関数を使用して呼び出しを遅延させる
    editor.getModel().onDidChangeContent(debounce(updateToFile, 300));
});

window.addEventListener("load", (event) => {
    const hashmap = {
            data : "",
            file_name : "edit",
            file_type : "txt"
        }
    
    fetch("generateToFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(hashmap)
    })
    .then(response => response.text())
    .then(data => {
        // PHPからの戻り値を確認可能だが、今回は設定しない
    })
    .catch(error => {
        console.error("Error:", error);
    });
});

document.getElementById('inputName').addEventListener('keydown', function() {
    const inputName = this.value;
    const errorMessage = document.getElementById('errorMessage');
    const submitButton = document.getElementById('submitButton');
    const invalidChars = /[<>:".\/\\|?*]/;

    if (invalidChars.test(inputName)) {
        errorMessage.classList.add("text-danger");
        submitButton.disabled = true;
    } else {
        errorMessage.classList.remove("text-danger");
        submitButton.disabled = false;
    }
});
