<template>
  <h1 class="text-3xl font-semibold mt-5 mb-10">Sort Products</h1>
    <div class="border-[1px] border-black/10 rounded-lg p-5 grid grid-cols-4 gap-3">
      <div
        v-for="(item, index) in products"
        :key="index"
        class="draggable-item"
        @click="open = true"
        draggable="true"
        @dragstart="onDragStart(index)"
        @dragover.prevent
        @drop="onDrop(index)"
      >
        <!-- {{ item }} -->
          <div class="flex items-center justify-center rounded-lg flex-col h-[180px] cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            <p>Add Product</p>
          </div>
      </div>
    </div>
    
    <Modal :open="open" @closeModal="closeModal" class="overflow-visible"can-close-backdrop>
      <div class="h-[200px]">
      <h1 class="text-xl text-black font-semibold mt-5 mb-3">Add Product</h1>
      <multiselect class="block w-full p-0  rounded-md font-semibold text-sm text-primary bg-gray-00 outline-none disabled:cursor-not-allowed transition-all focus:ring-2 focus:ring-slate-300 border border-gray-300 focus:border-slate-400': true"  v-model="value" :options="options" :custom-label="nameWithLang" placeholder="Select one" label="name"
      track-by="name"></multiselect>
    </div>
    </Modal>
  </template>
  
  <script>
import Modal from '@/Components/Atoms/Modal.vue';
import Multiselect from 'vue-multiselect';
import "vue-multiselect/dist/vue-multiselect.css";

  export default {
    components : {
      Modal,
      Multiselect
    },
    data() {
      return {
        products: Array(8).fill(null),
        draggedIndex: null,
        open : false,
        value: {name: 'Vue.js', language: 'JavaScript'},
        options: [
          {name: 'Vue.js', language: 'JavaScript'},
          {name: 'Rails', language: 'Ruby'},
          {name: 'Sinatra', language: 'Ruby'},
          {name: 'Laravel', language: 'PHP'},
          {name: 'Phoenix', language: 'Elixir'}
        ]
      };
    },
    methods: {
      onDragStart(index) {
        this.draggedIndex = index;
      },
      onDrop(index) {
        // Swap the dragged item with the target item
        const draggedItem = this.products[this.draggedIndex];
        this.products.splice(this.draggedIndex, 1);
        this.products.splice(index, 0, draggedItem);
        this.draggedIndex = null; // Reset dragged index
      },
      closeModal(){
        this.open  = false;
      },
      nameWithLang ({name, language}) {
        return `${name} — [${language}]`
      }
    }
  };
  </script>
  
  <style>
  .draggable-item {
    padding: 10px;
    margin-bottom: 5px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 10px;;
    cursor: grab;
  }
  </style>
  