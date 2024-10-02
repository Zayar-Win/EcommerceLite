<template>
    <div>
      <div
        v-for="(item, index) in items"
        :key="index"
        class="draggable-item"
        draggable="true"
        @dragstart="onDragStart(index)"
        @dragover.prevent
        @drop="onDrop(index)"
      >
        {{ item }}
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        items: ["Item 1", "Item 2", "Item 3", "Item 4"],
        draggedIndex: null
      };
    },
    methods: {
      onDragStart(index) {
        this.draggedIndex = index;
      },
      onDrop(index) {
        // Swap the dragged item with the target item
        const draggedItem = this.items[this.draggedIndex];
        this.items.splice(this.draggedIndex, 1);
        this.items.splice(index, 0, draggedItem);
        this.draggedIndex = null; // Reset dragged index
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
    cursor: grab;
  }
  </style>
  