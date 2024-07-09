function sendNotification(type, text) {
    let notificationBox = document.querySelector(".notification-box");
    const alerts = {
        error: {
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>`,
            color: "red-500",
        },
        ok: {
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>`,
            color: "green-500",
        },
        //     ok: {
        //         icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        //   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        // </svg>`,
        //         color: "green-500",
        //     },
    };

    if (!alerts[type]) {
        console.error(`Alert type "${type}" is not defined`);
        return;
    }

    let component = document.createElement("div");
    component.className = `relative flex items-center bg-${alerts[type].color} text-white text-sm font-bold px-4 py-3 rounded-md opacity-0 transform transition-all duration-500 mb-1`;
    component.innerHTML = `${alerts[type].icon}<p>${text}</p>`;
    notificationBox.appendChild(component);

    // Mostrar la alerta
    setTimeout(() => {
        component.classList.remove("opacity-0");
        component.classList.add("opacity-1");
    }, 1);

    // Ocultar la alerta después de 5 segundos
    setTimeout(() => {
        component.classList.remove("opacity-1");
        component.classList.add("opacity-0");
        component.style.margin = 0;
        component.style.padding = 0;
    }, 5000);

    // Reducir la altura para animación
    setTimeout(() => {
        component.style.setProperty("height", "0", "important");
    }, 5100);

    // Remover el componente después de la animación
    setTimeout(() => {
        notificationBox.removeChild(component);
    }, 5700);
}
