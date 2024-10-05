<script setup>
import { ref, computed } from "vue";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFilePoster from "filepond-plugin-file-poster";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImageTransform from "filepond-plugin-image-transform";
import FilePondPluginImageResize from "filepond-plugin-image-resize";
import FilePondPluginImageValidateSize from "filepond-plugin-image-validate-size";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageTransform,
    FilePondPluginImageResize,
    FilePondPluginFilePoster,
    FilePondPluginImageValidateSize
);

const props = defineProps({
    mode: {
        type: String,
        default: "image",
        validator: (value) => ["avatar", "image"].includes(value),
    },
    name: {
        type: String,
        default: "filepond",
    },
    labelIdle: {
        type: String,
        default: "Click to choose image, or Drop files here...",
    },
    allowMultiple: {
        type: Boolean,
        default: false,
    },
    acceptedFileTypes: {
        type: Array,
        default: () => ["image/*"],
    },
    imageCropAspectRatio: {
        type: String,
        default: "1:1",
    },
    stylePanelLayout: {
        type: String,
        default: "compact",
    },
    imagePreviewHeight: {
        type: Number,
        default: 300,
    },
    imageResizeTargetWidth: {
        type: Number,
        default: 300,
    },
    imageResizeTargetHeight: {
        type: Number,
        default: 300,
    },
    maxFileSize: {
        type: String,
        default: "10MB",
    },
    images: {
        type: Array,
        default: "",
    },
    maxFiles: {
        type: Number,
        default: 1,
    },
    files: {
        type: Array,
        default: "",
    },
});
const emit = defineEmits(["updateFile"]);

// let myFiles = ref([]);
const pond = ref(null);
const handleProcessFile = (file) => {
  console.log('Processing file:', file);
};

// const serverConfig = computed(() => ({
//   // Configure your server settings here
//   process: {
//     url: "./images/upload",
//     onerror: (response) => {
//       console.error(JSON.parse(response));
//     },
//     headers: {
//       "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf_token"]').content,
//     },
//   },
// }));
// const images = computed(() => {

//     if (props.images) {
//         return [
//             {
//                 options: {
//                     file: props.images,
//                     metadata: {
//                         poster: props.images,
//                     },
//                 },
//             },
//         ];
//     }

//     return [];
// });
const images = ref([]);
if (props.files && props.files.length > 0) {
    images.value = props.files.map((file) => {
        const filePath = `${file}`;

        // return {
        //     options: {
        //         file: filePath,
        //         metadata: {
        //             poster: filePath,
        //         },
        //     },
        // };
        return {
            source: filePath,  // The source of the file (from the DB)
            options: {
                type: 'local',  // Indicates that the file is a local file (already uploaded)
                file: file,  // The file name
                
                metadata: {
                    poster: filePath,  // Preview image path
                },
            },
        };
    });
}
// if (props.files && props.files.length > 0) {
//     images.value = props.files.map((file) => {
//         const filePath = `/storage/${file}`;
//         return {
//             source: filePath,
//             options: {
//                 type: 'local',
//                 file: {
//                     name: file,
//                     size: 123456, 
//                     type: 'image/jpeg', 
//                 },
//                 metadata: {
//                     poster: filePath,
//                 },
//             },
//         };
//     });
// }
console.log(images.value);
const filePondInitialized = () => {
    console.log("FilePond has initialized", pond.value);
};

const handleFilePondUpdate = (fileItems) => {
    fileItems.map((fileItem) => console.log(fileItem.file));
    if(props.allowMultiple){
        emit(
            "updateFile",
            // fileItems[0]?.file
            fileItems.map((fileItem) => fileItem.file)
        );
    }else{
        emit('updateFile',fileItems[0].file)
    }
};
</script>

<template>
    <div
        :class="{
            'avatar-upload border border-gray-300 shadow-sm': mode === 'avatar',
            'normal-upload': images.length > 0 && mode === 'image',
        }"
    >
        <FilePond
            ref="pond"
            :name="name"
            :label-idle="labelIdle"
            :files="images"
            :allowMultiple="allowMultiple"
            :FilePondPluginImageCrop="true"
            :acceptedFileTypes="acceptedFileTypes"
            :stylePanelLayout="mode === 'avatar' ? 'circle' : stylePanelLayout"
            :styleButtonRemoveItemPosition="
                mode === 'avatar' ? 'bottom-center' : 'top-left'
            "
            :imageCropAspectRatio="imageCropAspectRatio"
            :imageResizeTargetWidth="imageResizeTargetWidth"
            :imageResizeTargetHeight="imageResizeTargetHeight"
            :maxFiles="maxFiles"
            @updatefiles="handleFilePondUpdate"
            @processfile="handleProcessFile"
            max-file-size="maxFileSize"
            @init="filePondInitialized"
        />
        <!-- :imageCropAspectRatio="imageCropAspectRatio" -->

        <!-- :styleItemPanelAspectRatio="'1:1'" -->
        <!-- @processfile="handleProcessFile" -->
        <!-- :server="serverConfig" -->
    </div>
</template>
<style>
    @import "filepond/dist/filepond.min.css";
    @import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";


.filepond--item {
        height: 230px; 
    }

    /* Make sure the images inside the FilePond item fit the container */

</style>
<!-- <style scoped>

.avatar-upload {
  width: 160px;
  height: 160px;
  margin: auto;
  border-radius: 50%;
  overflow: hidden;
  position: relative;
}

.normal-upload {
  /* Define styles for normal mode if needed */
  width: 450px;
  height: auto;
  margin: auto;
  overflow: hidden;
  position: relative;
}

.filepond--root {
  border-radius: 50%;
}

.filepond--panel-root {
  border-radius: 50%;
}

.filepond--item-panel {
  border-radius: 50%;
}

.filepond--drop-label {
  border-radius: 50%;
}

.filepond--image-preview-wrapper {
  border-radius: 50%;
}

.filepond--image-preview {
  border-radius: 50%;
}

.filepond--file-info-sub {
  display: none;
}

.filepond--root,
.filepond--root .filepond--drop-label {
  background-color: #f9fafb;
}

@media (max-width: 640px) { /* Tailwind's sm breakpoint */
  .normal-upload {
    width: 100%; /* Full width on small screens */
    max-width: 100%;
  }
}
</style> -->
