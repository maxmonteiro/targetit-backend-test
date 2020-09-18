<template>
    <div>
        <ul>
            <li>
                <router-link :to="{ name: 'home' }">
                    Home
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'signin' }">
                    Entrar
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'users' }">
                    Usuários
                </router-link>
            </li>
            <li>
                Máximo Henrique
            </li>
            <li>
                <a href="#">
                    Sair
                </a>
            </li>
        </ul>
    </div>
</template>
