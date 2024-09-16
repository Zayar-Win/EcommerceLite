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
        default: 400,
    },
    imageResizeTargetWidth: {
        type: Number,
        default: 200,
    },
    imageResizeTargetHeight: {
        type: Number,
        default: 200,
    },
    maxFileSize: {
        type: String,
        default: "1MB",
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
console.log("this is filepond.vue" + props.images);
const emit = defineEmits(["updateFile"]);

// let myFiles = ref([]);
const pond = ref(null);

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
        const filePath = `/storage/${file}`;

        return {
            options: {
                file: filePath,
                metadata: {
                    poster: filePath,
                },
            },
        };
    });
}

console.log(images.value);
const filePondInitialized = () => {
    console.log("FilePond has initialized", pond.value);
};

const handleFilePondUpdate = (fileItems) => {
    console.log("FilePond has updated", fileItems.file);
    fileItems.map((fileItem) => console.log(fileItem.file));
    emit(
        "updateFile",
        // fileItems[0]?.file
        fileItems.map((fileItem) => fileItem.file)
    );
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
            :imagePreviewMaxHeight="250"
            :acceptedFileTypes="acceptedFileTypes"
            :imageCropAspectRatio="imageCropAspectRatio"
            :imageValidateSizeMinWidth="300"
            :imageValidateSizeMinHeight="300"
            :imageValidateSizeMaxWidth="1500"
            :imageValidateSizeMaxHeight="1500"
           
            :stylePanelLayout="mode === 'avatar' ? 'circle' : stylePanelLayout"
            :styleButtonRemoveItemPosition="
                mode === 'avatar' ? 'bottom-center' : 'top-left'
            "
            :imagePreviewHeight="imagePreviewHeight"
            :imageResizeTargetWidth="imageResizeTargetWidth"
            :imageResizeTargetHeight="imageResizeTargetHeight"
            :maxFiles="maxFiles"
            @updatefiles="handleFilePondUpdate"
            max-file-size="maxFileSize"
            @init="filePondInitialized"
        />
        <!-- :styleItemPanelAspectRatio="'1:1'" -->
        <!-- @processfile="handleProcessFile" -->
        <!-- :server="serverConfig" -->
    </div>
</template>
<style>
.filepond--item {
    width: calc(20% - 0.5em);
    /* min-height: 200px;  */
    min-height: 300px !important;
    margin-bottom: 1em;
    /* overflow: hidden; */
    /* position: relative; */
}
</style>
<!-- <style scoped>
@import "filepond/dist/filepond.min.css";
@import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

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
