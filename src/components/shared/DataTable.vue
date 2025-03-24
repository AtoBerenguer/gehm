<template>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th v-for="(header, key) in headers" :key="key">
                        {{ header }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in paginatedData" :key="index" @click="seleccionarObjeto(item)" >
                    <td v-for="(header, key) in headers" :key="key">
                        {{ item[key] }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Anterior</button>
            <span>Página {{ currentPage }} de {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Siguiente</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Array,
            required: true,
        },
        headers: {
            type: Object, // key: Nombre del header 
            required: true,
        },
        itemsPerPage: {
            type: Number,
            default: 15,
        },
    },
    data() {
        return {
            currentPage: 1,
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.data.length / this.itemsPerPage);
        },
        paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.data.slice(start, start + this.itemsPerPage);
        },
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        seleccionarObjeto(item) {
           
            this.$emit("objetoSeleccionado", item);
            
        },
    },
};
</script>

<style scoped>
.table-container {
    width: 100%;
    overflow-x: auto;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    color: white;
}

th,
td {
    padding: 10px;
    border: 1px solid #ddd;
}

th {
    background: #16a085;
    color: white;
}

tbody tr:nth-child(even) {
    background-color: #34495e;
}

tbody tr:nth-child(odd) {
    background-color: #2f3c4a;
}

.pagination {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

button {
    margin: 5px;
    padding: 5px 10px;
    background: #16a085;
    color: white;
    border: none;
    cursor: pointer;
}

button:disabled {
    background: gray;
}
</style>