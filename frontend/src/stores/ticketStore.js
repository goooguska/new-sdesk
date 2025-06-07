import { defineStore } from 'pinia';
import { ref } from 'vue';
import axiosInstance from '@/utils/api.js';

export const useTicketStore = defineStore('ticketStore', () => {
    const state = ref({
        tickets: [],
        isLoading: false,
        errors: {},
        selectedTicket: null
    });

    const getAll = async () => {
        state.value.isLoading = true;
        try {
            const { data } = await axiosInstance.get('/tickets');
            state.value.tickets = data;
        } catch (error) {
            handleError(error);
        } finally {
            state.value.isLoading = false;
        }
    };

    const createTicket = async (formData) => {
        state.value.errors = {};
        try {
            const { data } = await axiosInstance.post('/tickets/create', formData);
            if (!Array.isArray(state.value.tickets)) {
                state.value.tickets = [];
            }
            state.value.tickets.push(data);
            return true;
        } catch (error) {
            handleError(error);
            return false;
        }
    };

    const getTicket = async (id) => {
        state.value.isLoading = true;
        try {
            const { data } = await axiosInstance.get(`/tickets/${id}`);
            state.value.selectedTicket = data;
        } catch (error) {
            handleError(error);
        } finally {
            state.value.isLoading = false;
        }
    };

    const updateTicket = async (id, formData) => {
        try {
            const { data } = await axiosInstance.patch(`/tickets/${id}/update`, formData);
            const index = state.value.tickets.findIndex(ticket => ticket.id === id);
            if (index !== -1) {
                state.value.tickets[index] = data;
            }
            return true;
        } catch (error) {
            handleError(error);
            return false;
        }
    };

    const deleteTicket = async (id) => {
        try {
            await axiosInstance.delete(`/tickets/${id}/delete`);
            state.value.tickets = state.value.tickets.filter(ticket => ticket.id !== id);
            return true;
        } catch (error) {
            handleError(error);
            return false;
        }
    };

    const handleError = (error) => {
        state.value.errors = error.response?.data?.errors || {
            general: [error.response?.data?.message || 'Произошла ошибка при работе с заявками']
        };
    };

    return {
        state,
        getAll,
        getTicket,
        createTicket,
        updateTicket,
        deleteTicket
    };
});
