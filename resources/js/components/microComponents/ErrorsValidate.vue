<template>
    <div v-show="errors.all().length" >
        <ul>
            <li v-for="(error, i) in errors.all()">{{error}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ErrorsValidate",
        template: 'errors-validate-component',
    }
</script>