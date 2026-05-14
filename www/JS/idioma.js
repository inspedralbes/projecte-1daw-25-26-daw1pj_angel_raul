const traducciones = {
    es: {
        titulo_panel: "Panel Principal",
        que_hacemos: "¿Qué hacemos hoy, Instituto?",
        crear_incidencia: "Crear una incidencia",
        crear_incidencia_desc: "Reporta un problema rápidamente",
        seguimiento: "Seguimiento",
        seguimiento_desc: "Consulta el estado de tu incidencia",
        panel_tecnico: "Panel técnico",
        panel_tecnico_desc: "Acceso para técnicos",
        admin: "Administrador",
        admin_desc: "Gestión avanzada del sistema",
        rotativo: "Bienvenido al gestor de incidencias",

        detalla_incidencia: "Detalla tu incidencia",
        ph_titulo: "Título",
        ph_descripcion: "Descripción",
        sel_departamento: "Selecciona un departamento",
        btn_enviar: "Enviar",

        tu_numero: "Tu número de incidencia es",
        apunta_numero: "Apunta este número para hacer seguimiento",
        volver_inicio: "Volver al inicio",

        identificacion_admin: "Identificación de administrador",
        identificacion_tecnico: "Identifícate, por favor",
        codigo_verificacion: "Código de verificación",
        entrar_admin: "Entrar como administrador",
        entrar_tecnico: "Entrar como técnico",
        codigo_incorrecto: "Código incorrecto",

        pon_numero: "Pon tu número de incidencia",
        numero_incidencia: "Número de incidencia",
        buscar: "Buscar",
        buscar_otra: "Buscar otra",
        incidencia_no_encontrada: "Incidencia no encontrada",

        gestionar_incidencia: "Gestionar incidencia",
        asunto: "Asunto",
        descripcion: "Descripción",
        fecha: "Fecha",
        actualizar: "Actualizar",
        estado: "Estado",
        prioridad: "Prioridad",
        comentario: "Comentario",
        guardar: "Guardar",
        comentarios_tecnico: "Comentarios del técnico",

        quien_eres: "¿Quién eres?",
        selecciona_nombre: "Selecciona tu nombre",
        accion: "Acción",

        panel_admin: "Panel Administrador",
        tecnico: "Técnico",
        asignar: "Asignar",

        creditos: "Angel Domínguez, Raul Diaz."
    },

    cat: {
        titulo_panel: "Panell Principal",
        que_hacemos: "Què fem avui, Institut?",
        crear_incidencia: "Crear una incidència",
        crear_incidencia_desc: "Informa d’un problema ràpidament",
        seguimiento: "Seguiment",
        seguimiento_desc: "Consulta l’estat de la teva incidència",
        panel_tecnico: "Panell tècnic",
        panel_tecnico_desc: "Accés per a tècnics",
        admin: "Administrador",
        admin_desc: "Gestió avançada del sistema",
        rotativo: "Benvingut al gestor d'incidències",

        detalla_incidencia: "Detalla la teva incidència",
        ph_titulo: "Títol",
        ph_descripcion: "Descripció",
        sel_departamento: "Selecciona un departament",
        btn_enviar: "Enviar",

        tu_numero: "El teu número d’incidència és",
        apunta_numero: "Apunta aquest número per fer el seguiment",
        volver_inicio: "Tornar a l’inici",

        identificacion_admin: "Identificació d’administrador",
        identificacion_tecnico: "Identifica’t, si us plau",
        codigo_verificacion: "Codi de verificació",
        entrar_admin: "Entrar com a administrador",
        entrar_tecnico: "Entrar com a tècnic",
        codigo_incorrecto: "Codi incorrecte",

        pon_numero: "Introdueix el teu número d’incidència",
        numero_incidencia: "Número d’incidència",
        buscar: "Cercar",
        buscar_otra: "Cercar una altra",
        incidencia_no_encontrada: "Incidència no trobada",

        gestionar_incidencia: "Gestionar incidència",
        asunto: "Assumpte",
        descripcion: "Descripció",
        fecha: "Data",
        actualizar: "Actualitzar",
        estado: "Estat",
        prioridad: "Prioritat",
        comentario: "Comentari",
        guardar: "Desar",
        comentarios_tecnico: "Comentaris del tècnic",

        quien_eres: "Qui ets?",
        selecciona_nombre: "Selecciona el teu nom",
        accion: "Acció",

        panel_admin: "Panell Administrador",
        tecnico: "Tècnic",
        asignar: "Assignar",

        creditos: "Àngel Domínguez, Raül Díaz."
    }
};


function cambiarIdioma(idioma) {
    localStorage.setItem("idioma", idioma);

    document.querySelectorAll("[data-key]").forEach(el => {
        const clave = el.getAttribute("data-key");
        const texto = traducciones[idioma][clave];

        if (!texto) return;

        if (el.placeholder !== undefined && el.placeholder !== "") {
            el.placeholder = texto;
        } else {
            el.textContent = texto;
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const idiomaGuardado = localStorage.getItem("idioma") || "es";
    cambiarIdioma(idiomaGuardado);
});

document.getElementById("btn-cat")?.addEventListener("click", () => cambiarIdioma("cat"));
document.getElementById("btn-es")?.addEventListener("click", () => cambiarIdioma("es"));
