function toggleSlPassword() {
    const pass = document.getElementById("sl-password");
    pass.type = pass.type === "password" ? "text" : "password";
  }
  
document.addEventListener('DOMContentLoaded', function () {
  const inputs = document.querySelectorAll('.sl-code-inputs input');

  inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
      const value = input.value;
      
      // Si plus d’un caractère (collé), on le répartit
      if (value.length > 1) {
        const chars = value.split('');
        for (let i = 0; i < chars.length; i++) {
          if (index + i < inputs.length) {
            inputs[index + i].value = chars[i];
          }
        }
        const nextIndex = Math.min(index + value.length, inputs.length - 1);
        inputs[nextIndex].focus();
      } else if (value !== '' && index < inputs.length - 1) {
        // Aller au champ suivant si 1 caractère
        inputs[index + 1].focus();
      }
    });

    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '' && index > 0) {
        // Retour au champ précédent si vide
        inputs[index - 1].focus();
      }
    });

    input.addEventListener('paste', (e) => {
      e.preventDefault();
      const paste = (e.clipboardData || window.clipboardData).getData('text');
      const chars = paste.split('');
      for (let i = 0; i < chars.length; i++) {
        if (index + i < inputs.length) {
          inputs[index + i].value = chars[i];
        }
      }
      const nextIndex = Math.min(index + chars.length, inputs.length - 1);
      inputs[nextIndex].focus();
    });
  });
});
