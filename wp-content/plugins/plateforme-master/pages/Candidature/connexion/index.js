function togglePassword() {
    const passInput = document.getElementById('password');
    passInput.type = passInput.type === 'password' ? 'text' : 'password';
}

function login(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    // alert(`Connexion avec:\nEmail: ${email}\nMot de passe: ${password}`);
    window.location.href = "../account-verification/index.html";

}