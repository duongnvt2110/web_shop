import Axios from "axios";

export default class UploadEditor {

    constructor( loader ) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }
    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise((resolve,reject) =>{
                let data = new FormData();
                data.append('image', file);
                axios.post('http://localhost/Laravel/shop/public/image/upload',data);
            }));
    }
}
