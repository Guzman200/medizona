<template>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                        Dashboard de {{nombre()}}
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        <a href="#" class="font-medium text-danger-600 hover:text-indigo-500">
                            Texto
                        </a>
                    </p>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    methods: {
        cerrarSesion() {
            axios
                .post("/api/logout")
                .then((response) => {
                    window.location.href = "/";
                })
                .catch(({ response }) => {
                    window.location.href = "/";
                });
        },
        nombre(){
            return localStorage.getItem('nombre');
        }
    },
};
</script>
