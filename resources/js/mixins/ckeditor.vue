<script>

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import UploadAdapter from '../ckeditor/UploadEditor.js';
    export default {
        data() {
            return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    extraPlugins: [this.MyCustomUploadAdapterPlugin],
                    image: {
                        toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full' , 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                        styles: [
                            'full',
                            'side',
                            'alignLeft',
                            'alignCenter',
                            'alignRight'
                        ]
                    }
                }
            };
        },
        methods: {
            MyCustomUploadAdapterPlugin ( editor ) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    return new UploadAdapter( loader );
                };
            }
        }
    }
</script>
