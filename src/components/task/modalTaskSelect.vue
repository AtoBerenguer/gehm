<template>
    <div class="modal">
        <div class="modal-content">
            <h3>TAREA SELECTED WORKS!</h3>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tarea: Object,
    },
    data() {
        return {
            roleId: null
        };
    },
    mounted() {
        this.roleId = localStorage.getItem("rol_id");
    },
};    
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;


}
.modal-content {
    background: #2c3e50;
    padding: 20px;
    border-radius: 12px;
    width: 400px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ecf0f1;

}

h3 {
    font-size: 1.5rem;
    color: #1abc9c;
    margin-bottom: 15px;
}

</style>