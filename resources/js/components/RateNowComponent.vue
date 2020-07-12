<template>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="card bg-light mb-3">
            <div class="card-header">La tasa de hoy</div>
            <div class="card-body">
                <h4 class="card-title">{{ rate }}</h4>
            </div>
        </div>
    </div>
</template>

<script>
    import {rateMixin} from "./mixins/rateMixin";

    export default {
        name: "RateNowComponent",
        template: 'rate-now-component',
        mixins: [rateMixin]
    }
</script>