import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const editor0Element = document.querySelector('.ckeditor0');
if (editor0Element) {
    ClassicEditor
        .create(editor0Element, {
            toolbar: [
                'bold',
                'italic',
                // 'underline',
                // 'strikethrough',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
}


const editor1Element = document.querySelector('.ckeditor1');
if (editor1Element) {
    ClassicEditor
        .create(editor1Element, {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                // 'underline',
                // 'strikethrough',
                '|',
                'link',
                // 'imageUpload',
                'bulletedList',
                'numberedList',
                'blockQuote',
                '|',
                'insertTable',
                'mediaEmbed',
                'horizontalLine',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
}

const editor2Element = document.querySelector('.ckeditor2');
if (editor2Element) {
    ClassicEditor
        .create(editor2Element, {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                // 'underline',
                // 'strikethrough',
                '|',
                'link',
                // 'imageUpload',
                'bulletedList',
                'numberedList',
                'blockQuote',
                '|',
                'insertTable',
                'mediaEmbed',
                'horizontalLine',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
}

const editor3Element = document.querySelector('.ckeditor3');
if (editor3Element) {
    ClassicEditor
        .create(editor3Element, {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'link',
                // 'imageUpload',
                'bulletedList',
                'numberedList',
                'blockQuote',
                '|',
                'insertTable',
                'mediaEmbed',
                'horizontalLine',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
}
