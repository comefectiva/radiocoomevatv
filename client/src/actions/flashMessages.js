import { ADD_FLASH_MESSAGE } from './types';

// Reducer for flash messages in the app
export function addFlashMessage(message) {
    return{
        type: ADD_FLASH_MESSAGE,
        message: message
    }
}