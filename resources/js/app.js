import Dropzone from "dropzone"

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function ()  {
        
        if(document.querySelector('[name="image"]').value.trim() ) {
            const imagePosted = {}
            imagePosted.size = 1234;
            imagePosted.name = document.querySelector('[name="image"]').value;
            
            this.options.addedfile.call( this, imagePosted );
            this.options.thumbnail.call( this, imagePosted, `/uploads/${imagePosted.name}` );
            imagePosted.previewElement.classList.add('dz-success', 'dz-complete');
            
        }
    }
})


dropzone.on('success', function(file, response) {

    document.querySelector('[name="image"]').value = response.image;
})


dropzone.on('removedfile', function() {
    document.querySelector('[name="image"]').value = ""
})

dropzone.on('error', function(file, response) {
    console.log("Error")
})