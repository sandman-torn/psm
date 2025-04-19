import { ref } from 'vue';
import axios from 'axios';

export default function useClass() {
  let classes = ref([]);

  const fetchClasses = async () => {
    try {
      let response = await axios.get('/api/classes');
      //console.log(response.data);

      classes.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  return { classes, fetchClasses };
}
