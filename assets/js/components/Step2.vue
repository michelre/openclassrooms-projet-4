<template>
    <div>
        <h1>Vos informations</h1>
        <hr/>
        <ul class="list-unstyled">
            <li v-for="(visitor, i) in reservation.visitors" :key="i">
                <form class="form-inline">
                    <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Nom et prénom"
                           v-model="visitor.fullName">
                    <select class="form-control mb-2 mr-sm-2" v-model="visitor.country">
                        <option value="">Pays</option>
                        <option value="fr">France</option>
                        <option value="it">Italie</option>
                        <option value="es">Espagne</option>
                        <option value="us">États-Unis</option>
                    </select>
                    <datepicker
                            placeholder="Date de naissance"
                            input-class="form-control"
                            :format="'dd/MM/yyyy'"
                            @selected="(d) => changeVisitorTarif(d, i)"
                    ></datepicker>
                    <div class="form-check mb-2 mr-sm-2">
                        <input class="form-check-input" type="checkbox" id="inlineFormCheck"
                               v-model="visitor.isHalf"
                               @change="() => changeVisitorTarif(i)">
                        <label class="form-check-label" for="inlineFormCheck">
                            Tarif réduit
                        </label>
                    </div>
                </form>
            </li>
        </ul>
        <button class="btn btn-primary" @click="() => navigateAction('Step1')">Précédent</button>
        <button class="btn btn-primary" @click="() => navigateAction('Step3')">Suivant</button>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        name: 'Step2',
        props: {
            reservation: Object,
            changeVisitorTarif: Function,
            navigateAction: Function
        },
        components: {
            Datepicker
        }
    }
</script>

<style lang="scss"></style>
