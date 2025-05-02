import { defineStore } from 'pinia'
import { ref } from "vue"
import axiosInstance from "@/utils/api.js"

export const useAuthStore = defineStore('authStore', () => {
  const state = ref({
    user: null,
    userEmail: null,
    waitCode: false,
    isAuthenticated: false,
    errors: {},
    isLoading: true,
    isInitialized: false
  })

  const me = async () => {
    if (state.value.isInitialized) return

    try {
      const { data } = await axiosInstance.get('/auth/me')
      state.value.user = data
      state.value.isAuthenticated = true
    } catch (error) {
      resetState()
    } finally {
      state.value.isLoading = false
      state.value.isInitialized = true
    }
  }

  const login = async (formData) => {
    state.value.errors = {}
    state.value.userEmail = null

    try {
      await axiosInstance.post('/auth/login', {
        email: formData.email,
        password: formData.password
      })

      state.value.waitCode = true
      state.value.userEmail = formData.email
      return true
    } catch (error) {
      handleAuthError(error)
      return false
    }
  }

  const verifyCode = async (code) => {
    try {
      const { data } = await axiosInstance.post('/auth/2fa', {
        email: state.value.userEmail,
        code: code
      })

      state.value.user = data
      state.value.isAuthenticated = true
      return true
    } catch (error) {
      handleAuthError(error)
      return false
    }
  }

  const logout = async () => {
    try {
      await axiosInstance.post('/auth/logout')
      resetState()
    } catch (error) {
      console.error('Ошибка при выходе:', error)
      handleAuthError(error)
    }
  }

  const handleAuthError = (error) => {
    if (error.response?.status === 401) resetState()

    state.value.errors = error.response?.data?.errors || {
      general: [error.response?.data?.message || 'Ошибка авторизации']
    }
  }

  const resetState = () => {
    state.value = {
      user: null,
      userEmail: null,
      waitCode: false,
      isAuthenticated: false,
      errors: {},
      isLoading: false,
      isInitialized: false
    }
  }

  return {
    state,
    login,
    verifyCode,
    me,
    logout
  }
})