<template>
  <div class="loader-container">
    <div class="loader"></div>
    <div class="loading-text">
      <slot>Загрузка...</slot>
    </div>
  </div>
</template>

<style scoped>
.loader-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
}

.loader {
  width: 200px;
  height: 200px;
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid var(--primary-color);
  animation: spin 1.5s linear infinite;
  margin-bottom: 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-text {
  color: var(--secondary-color);
  font-size: 20px;
}
</style>