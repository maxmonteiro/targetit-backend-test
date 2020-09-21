<template>
    <div>
        <nav :style="this.$route.name == 'signin' ? 'display: none!important;' : ''" class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Awesome meetings</a>
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
            <ul :style="this.$route.name == 'signin' ? 'display: none!important;' : ''"
                class="navbar-nav d-flex flex-row bd-highlight pl-3"
            >
                <li class="nav-item mr-2 text-nowrap">
                    <a class="nav-link" href="#" @click.prevent="logout">
                        <i class="fa fa-sign-out pr-1"></i>Sair
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav :style="this.$route.name == 'signin' ? 'display: none!important;' : ''"
                    id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
                >
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span><i class="fa fa-calendar text-primary"></i></span>
                                <router-link class="nav-link" :to="{ name: 'home' }">
                                    Agendamentos
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <span><i class="fa fa-map-pin text-primary"></i></span>
                                <router-link class="nav-link" :to="{ name: 'locals' }">
                                    Locais
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <span><i class="fa fa-users text-primary"></i></span>
                                <router-link class="nav-link" :to="{ name: 'sectors' }">
                                    Setores
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <span><i class="fa fa-user text-primary"></i></span>
                                <router-link class="nav-link" :to="{ name: 'users' }">
                                    Usuários
                                </router-link>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4"
                    :style="this.$route.name == 'signin' ? 'margin: 0 auto;' : ''"
                >
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        
                        <router-view />
                        
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            user: {}
        }
    },
    computed: {
        currentPage() {
            return this.$route.name
        }
    },
    mounted() {
        this.$eventHub.$on('logged-in', this.getUser());
    },
    methods: {
        getUser() {
            axios.get('api/auth/me')
            .then(({data}) => {
                this.user = data.data
            }).catch((err) => {
                console.log(err)
            });
        },
        logout() {
            // Remove token
            localStorage.removeItem('access_token')
            // Remove user name
            localStorage.removeItem('user_name')
            // Remove header
            axios.defaults.headers.common = {}
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
.nav-item {
    display: flex;
}
.nav-item span {
    align-self: center;
    width: 15px;
}
</style>