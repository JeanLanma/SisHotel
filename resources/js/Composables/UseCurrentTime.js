import { onBeforeUnmount, ref } from 'vue';

export const useCurrentTime = () => {
    const currentTime = ref(new Date().toLocaleTimeString());
    const updateCurrentTime = () => {
      currentTime.value = new Date().toLocaleTimeString();
    };
    const updateTimeInterval = setInterval(updateCurrentTime, 1000);
    onBeforeUnmount(() => {
      clearInterval(updateTimeInterval);
    });
    return {
      currentTime,
    };
};