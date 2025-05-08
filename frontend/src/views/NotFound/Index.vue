<script setup>

</script>

<template>
  <div class="not-found-container">
    <div class="not-found-content">
      <h1 class="error-code">404</h1>
      <p class="error-message">Страница не найдена</p>
      <p class="error-description">Извините, но запрашиваемая вами страница не существует или была удалена.</p>
      <router-link to="/" class="back-home-button">Вернуться на главную</router-link>
    </div>
  </div>
</template>

<style scoped>
.not-found-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.not-found-content {
  text-align: center;
  max-width: 400px;
}

.error-code {
  font-size: 5rem;
  font-weight: bold;
  color: var(--error-color);
}

.error-message {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--dark-gray);
  margin-top: 10px;
}

.error-description {
  font-size: 1rem;
  color: var(--gray);
  margin-top: 15px;
}

.back-home-button {
  display: inline-block;
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 1rem;
  background-color: var(--green);
  color: var(--white);
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.back-home-button:hover {
  background-color: var(--dark-green);
}
</style>
