// stores/user.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', {
    state: () => ({
      user: {},
    }),
    actions: {
      async fetchUser() {
        const response = await axios.get('/api/user');
        this.user = response.data; // Set the user data in the store
        console.log('user.unit_id:', this.user.unit_id); // Access the unit_id from the store
        console.log('Type of user.unit_id:', typeof this.user.unit_id); // Check the type of unit_id
      },
    },
  });