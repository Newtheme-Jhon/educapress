// Obtener el protocolo
const protocolo = window.location.protocol;
// Obtener el nombre del host
const nombreHost = window.location.hostname;
const route = protocolo + '//' + nombreHost + '/admin/ckeditor/upload';

const url = window.location.href;
const editOrCreatePattern = /\/admin\/posts\/([^\/]+)(\/edit)|\/admin\/posts\/create/;

import { ClassicEditor, 
    Essentials, 
    Bold, 
    Italic, 
    Font, 
    Paragraph,
    SimpleUploadAdapter,
    Image,
    ImageBlock,
    ImageInline,
    ImageUpload,
    ImageTextAlternative,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    LinkImage,
    TodoList,
    Autoformat,
    List,
    Heading,
    Table, TableToolbar,
    MediaEmbed,
    CodeBlock,
    
} from 'ckeditor5';


import 'ckeditor5/ckeditor5.css';

if (editOrCreatePattern.test(url)) {
    // Si la URL coincide con el patrón, ejecuta el script
    console.log("Estás en una página de edición o creación de posts");
    // Aquí va tu código JavaScript
    // ...

ClassicEditor
    .create( document.querySelector( '#content' ), {

        plugins: [ 
            Essentials, 
            Bold, 
            Italic, 
            Font, 
            Paragraph, 
            SimpleUploadAdapter,
            Image,
            ImageBlock,
            ImageInline,
            ImageUpload,
            ImageTextAlternative,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            LinkImage,
            TodoList,
            Autoformat,
            List,
            Heading,
            Table, TableToolbar,
            MediaEmbed,
            CodeBlock,
        ],

        toolbar: [
            'heading', '|',
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'TodoList', 'bulletedList', 'numberedList',

            '|', 'insertImage',
            

            'insertTable',
            'mediaEmbed',
            'codeBlock',

            '|', 

        ],
        image: {
            toolbar: [
                'imageStyle:inline',
                'imageStyle:side',
                'imageStyle:alignLeft',
                'imageStyle:alignRight',
                '|',
                
                'imageStyle:block',
                'imageStyle:alignBlockLeft',
                'imageStyle:alignBlockRight',
                'imageStyle:alignCenter',
                '|',

                'toggleImageCaption',
                'imageTextAlternative',
                '|',
                'imageResize',
                '|',
                'linkImage'
            ],
            insert: {
                // If this setting is omitted, the editor defaults to 'block'.
                // See explanation below.
                type: 'auto'
            }
        },
        simpleUpload: {
            // Feature configuration.
            // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
            uploadUrl: route,

            // Enable the XMLHttpRequest.withCredentials property.
            withCredentials: true,

            // Headers sent along with the XMLHttpRequest to the upload server.
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        }

    } )
    .then( /* ... */ )
    .catch( error => {
        console.error( error );
    } );

    /**----------------excerpt--------------------------------- */

    ClassicEditor
    .create( document.querySelector( '#excerpt' ), {

        plugins: [ 
            Essentials, 
            Bold, 
            Italic, 
            Font, 
            Paragraph, 
            SimpleUploadAdapter,
            Image,
            ImageBlock,
            ImageInline,
            ImageUpload,
            ImageTextAlternative,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            LinkImage,
            TodoList,
            Autoformat,
            List,
            Heading,
            Table, TableToolbar,
            MediaEmbed,
            CodeBlock,
        ],

        toolbar: [
            'heading', '|',
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'TodoList', 'bulletedList', 'numberedList',

            '|', 'insertImage',

            'insertTable',
            'mediaEmbed',
            'codeBlock',

            '|', 

        ],
        image: {
            toolbar: [
                'imageStyle:inline',
                'imageStyle:side',
                'imageStyle:alignLeft',
                'imageStyle:alignRight',
                '|',
                
                'imageStyle:block',
                'imageStyle:alignBlockLeft',
                'imageStyle:alignBlockRight',
                'imageStyle:alignCenter',
                '|',

                'toggleImageCaption',
                'imageTextAlternative',
                '|',
                'imageResize',
                '|',
                'linkImage'
            ],
            insert: {
                // If this setting is omitted, the editor defaults to 'block'.
                // See explanation below.
                type: 'auto'
            }
        },
        simpleUpload: {
            // Feature configuration.
            // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
            uploadUrl: route,

            // Enable the XMLHttpRequest.withCredentials property.
            withCredentials: true,

            // Headers sent along with the XMLHttpRequest to the upload server.
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        }

    } )
    .then( /* ... */ )
    .catch( error => {
        console.error( error );
    } );


}


/**
 * Instructor/courses/slug/edit (description y resumen)
 */
const editCourses = /\/instructor\/courses\/([^\/]+)\/edit/;

if (editCourses.test(url)) {

    //RESUMEN DEL CURSO
    ClassicEditor
    .create( document.querySelector( '#editCourseResum' ), {

        plugins: [ 
            Essentials, 
            Bold, 
            Italic, 
            Font, 
            Paragraph, 
            SimpleUploadAdapter,
            TodoList,
            Autoformat,
            List,
            Heading,
            Table, TableToolbar,
            MediaEmbed,
        ],

        toolbar: [
            'heading', '|',
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'TodoList', 'bulletedList', 'numberedList',

            'insertTable',
            'mediaEmbed',

            '|', 

        ],

    } )
    .then( /* ... */ )
    .catch( error => {
        console.error( error );
    } );

    //DESCRIPCION DEL CURSO
    ClassicEditor
    .create( document.querySelector( '#editCourseDescription' ), {

        plugins: [ 
            Essentials, 
            Bold, 
            Italic, 
            Font, 
            Paragraph, 
            SimpleUploadAdapter,
            TodoList,
            Autoformat,
            List,
            Heading,
            Table, TableToolbar,
            MediaEmbed,
        ],

        toolbar: [
            'heading', '|',
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
            'TodoList', 'bulletedList', 'numberedList',

            'insertTable',
            'mediaEmbed',

            '|', 

        ],

    } )
    .then( /* ... */ )
    .catch( error => {
        console.error( error );
    } );

}

/**
 * Instructor/courses/slug/curriculum (lesson description)
 */
const curriculumCourses = /\/instructor\/courses\/([^\/]+)\/curriculum/;
if(curriculumCourses.test(url)) {

    Livewire.on('ckLessonEditor', (object) => {
    
        //const editor = document.querySelector('#lessonEditor')
        const editor = object[0];
        const content = object[1];
        //console.log(editor)
    
        ClassicEditor
        .create( editor, {
    
            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                TodoList,
                Autoformat,
                List,
                Heading,
                Table, TableToolbar,
                MediaEmbed,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'TodoList', 'bulletedList', 'numberedList',
    
                'insertTable',
                'mediaEmbed',
    
                '|', 
    
            ],
    
        } )
        .then(editor => {
            
    
            editor.setData(content);
    
            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                //console.log(valor)
                Livewire.dispatch('updatedValueLessonEdit', [valor]);
            } );
    
        })
        .catch( error => {
            console.error( error );
        } );
    
    });

}

//validar ruta: http://educapress.test/courses-status/

const coursesStatus = /\/courses-status\//;

if(coursesStatus.test(url)) {

    //QUESTIONS CREATE
    Livewire.on('initializeCKEditor', () => {
        const editor = document.querySelector('#ckEditorQuestions')
        
        ClassicEditor
        .create( editor, {

            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                Image,
                ImageBlock,
                ImageInline,
                ImageUpload,
                ImageTextAlternative,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                LinkImage,
                Autoformat,
                Heading,
                MediaEmbed,
                CodeBlock,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
    
                '|', 'insertImage',
    
                'mediaEmbed',
                'codeBlock',
    
                '|', 
    
            ],
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    
                    'imageStyle:block',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignCenter',
                    '|',
    
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageResize',
                    '|',
                    'linkImage'
                ],
                insert: {
                    // If this setting is omitted, the editor defaults to 'block'.
                    // See explanation below.
                    type: 'auto'
                }
            },
            simpleUpload: {
                // Feature configuration.
                // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
                uploadUrl: route,
    
                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,
    
                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }
    
        } )
        .then( editor => {

            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                //console.log(valor);
                Livewire.dispatch('createMessage', [valor]);

            } );
            
            Livewire.on('clean-editor', () => {
                //asi formateamos el editor
                editor.setData('');
            });
    
    
        })
        .catch( error => {
            console.error( error );
        } );
    });


    //QUESTIONS EDIT
    Livewire.on('initckEdit', (value) => {
        const edit = document.querySelector('#ckedit');

        ClassicEditor
        .create( edit, {

            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                Image,
                ImageBlock,
                ImageInline,
                ImageUpload,
                ImageTextAlternative,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                LinkImage,
                Autoformat,
                Heading,
                MediaEmbed,
                CodeBlock,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
    
                '|', 'insertImage',
    
                'mediaEmbed',
                'codeBlock',
    
                '|', 
    
            ],
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    
                    'imageStyle:block',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignCenter',
                    '|',
    
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageResize',
                    '|',
                    'linkImage'
                ],
                insert: {
                    // If this setting is omitted, the editor defaults to 'block'.
                    // See explanation below.
                    type: 'auto'
                }
            },
            simpleUpload: {
                // Feature configuration.
                // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
                uploadUrl: route,
    
                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,
    
                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }
    
        } )
        .then( editor => {

            //asi formateamos el editor
            editor.setData(value);
        
            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                //console.log(valor)
                Livewire.dispatch('updatedValor', [valor]);
            } );
    
    
            Livewire.on('clean-editor', () => {
                //asi formateamos el editor
                editor.setData('');
            });
    
    
        })
        .catch( error => {
            console.error( error );
        } );

    });

    //ANSWERS CREATED
    Livewire.on('initckEditorAnswers', () => {
        const editor = document.querySelector('#ckEditorAnswers')

        ClassicEditor
        .create( editor, {

            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                Image,
                ImageBlock,
                ImageInline,
                ImageUpload,
                ImageTextAlternative,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                LinkImage,
                Autoformat,
                Heading,
                MediaEmbed,
                CodeBlock,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
    
                '|', 'insertImage',
    
                'mediaEmbed',
                'codeBlock',
    
                '|', 
    
            ],
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    
                    'imageStyle:block',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignCenter',
                    '|',
    
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageResize',
                    '|',
                    'linkImage'
                ],
                insert: {
                    // If this setting is omitted, the editor defaults to 'block'.
                    // See explanation below.
                    type: 'auto'
                }
            },
            simpleUpload: {
                // Feature configuration.
                // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
                uploadUrl: route,
    
                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,
    
                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }
    
        } )
        .then( editor => {

            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                Livewire.dispatch('createAnswerMessage', [valor]);
            } );
    
        })
        .catch( error => {
            console.error( error );
        } );
    });

    //ANSWERS EDIT
    Livewire.on('initckAnswerEdit', (value) => {
        const edit = document.querySelector('#ckAnswerEdit')
        
        ClassicEditor
        .create( edit, {

            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                Image,
                ImageBlock,
                ImageInline,
                ImageUpload,
                ImageTextAlternative,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                LinkImage,
                Autoformat,
                Heading,
                MediaEmbed,
                CodeBlock,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
    
                '|', 'insertImage',
    
                'mediaEmbed',
                'codeBlock',
    
                '|', 
    
            ],
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    
                    'imageStyle:block',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignCenter',
                    '|',
    
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageResize',
                    '|',
                    'linkImage'
                ],
                insert: {
                    // If this setting is omitted, the editor defaults to 'block'.
                    // See explanation below.
                    type: 'auto'
                }
            },
            simpleUpload: {
                // Feature configuration.
                // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
                uploadUrl: route,
    
                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,
    
                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }
    
        } )
        .then( editor => {

            //asi formateamos el editor
            editor.setData(value);
        
            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                Livewire.dispatch('updatedValor', [valor]);
            } );
    
        })
        .catch( error => {
            console.error( error );
        } );

    });

    //ANSWER TO ANSWER
    Livewire.on('initckEditorAnswersToAnswer', () => {
        const editor = document.querySelector('#ckEditorAnswerToAnswer')

        ClassicEditor
        .create( editor, {

            plugins: [ 
                Essentials, 
                Bold, 
                Italic, 
                Font, 
                Paragraph, 
                SimpleUploadAdapter,
                Image,
                ImageBlock,
                ImageInline,
                ImageUpload,
                ImageTextAlternative,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                LinkImage,
                Autoformat,
                Heading,
                MediaEmbed,
                CodeBlock,
            ],
    
            toolbar: [
                'heading', '|',
                'undo', 'redo', '|', 'bold', 'italic', '|',
    
                '|', 'insertImage',
    
                'mediaEmbed',
                'codeBlock',
    
                '|', 
    
            ],
            image: {
                toolbar: [
                    'imageStyle:inline',
                    'imageStyle:side',
                    'imageStyle:alignLeft',
                    'imageStyle:alignRight',
                    '|',
                    
                    'imageStyle:block',
                    'imageStyle:alignBlockLeft',
                    'imageStyle:alignBlockRight',
                    'imageStyle:alignCenter',
                    '|',
    
                    'toggleImageCaption',
                    'imageTextAlternative',
                    '|',
                    'imageResize',
                    '|',
                    'linkImage'
                ],
                insert: {
                    // If this setting is omitted, the editor defaults to 'block'.
                    // See explanation below.
                    type: 'auto'
                }
            },
            simpleUpload: {
                // Feature configuration.
                // uploadUrl: "http://educapress.test/admin/ckeditor/upload",
                uploadUrl: route,
    
                // Enable the XMLHttpRequest.withCredentials property.
                withCredentials: true,
    
                // Headers sent along with the XMLHttpRequest to the upload server.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            }
    
        } )
        .then( editor => {

            editor.model.document.on('change:data', () => {
                const valor = editor.getData();
                Livewire.dispatch('answer-to-answer', [valor]);
            } );
    
        })
        .catch( error => {
            console.error( error );
        } );
    });

}
