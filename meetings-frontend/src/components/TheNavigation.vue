<template>
    <div>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
            <button
                class="navbar-toggler position-absolute d-md-none collapsed "
                type="button"
                data-toggle="collapse"
                data-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
                style="top: 10px; right: 0px;"
                >
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav d-flex flex-row bd-highlight">
                <li class="nav-item mr-4 pl-3" style="align-self: center;">
                    <span class="text-light">Máximo Henrique</span>
                </li>
                <li class="nav-item mr-2 text-nowrap">
                    <a class="nav-link" href="#" @click.prevent="logout">Sair</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'home' }">
                                    Home
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'signin' }">
                                    Entrar
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'users' }">
                                    Usuários
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <router-view/>
                        
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {}
    },
    methods: {
        logout() {
            localStorage.removeItem('access_token')
            this.$router.push('/signin');
        }
    }
}
</script>

<style scoped>
.navbar {
    background: #9b59b6!important;
}
#sidebarMenu {
    height: calc(100vh - 48px);
}
</style>