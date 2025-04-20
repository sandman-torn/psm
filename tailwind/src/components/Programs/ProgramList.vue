<template>
    <div class="program-list">
      <h5>Program List</h5>
      <ul>
        <li v-for="program in programs" :key="program.id" class="program-item">
          <div>
            <strong>{{ program.title }}</strong>
            <p>{{ program.description }}</p>
            <small>{{ program.date }}</small>
          </div>
          <button @click="editProgram(program)">Edit</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  const props = defineProps({
    programs: Array
  })
  
  const emit = defineEmits(['editProgram'])
  
  const editProgram = (program) => {
    emit('editProgram', program)
  }
  </script>
  
  <style scoped>
  .program-list {
    margin-top: 20px;
  }
  
  .program-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
  }
  
  button {
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #45a049;
  }
  </style>
  