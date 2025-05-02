<template>
  <div class="auth-layout">
    <header>Личный кабинет</header>
    <nav>...</nav>
    <main>
      <slot></slot>
    </main>
  </div>
</template>

<style scoped>
.auth-layout {
  background-color: white;
  min-height: 100vh;
}
</style>