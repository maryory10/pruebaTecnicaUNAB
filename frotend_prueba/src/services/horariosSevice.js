import axios from 'axios'
const api = axios.create({

baseURL:'http://localhost:8000/api'

})

export default {
    async getAll(params){
        try{
            const res = await api.get("/listarHorarios", { params })
        return res.data

        }catch(error){
            console.log("error backend", error)
            throw error
        }
        
    },
    async createHorario(datos){
        try{
            const res = await api.post("/crearHorarios", datos)
        return res.data

        }catch(error){
            const mensajeBackend = error.response?.data?.error || "Error al crear el horario";
        console.error("Error backend:", error);
            throw error
        }
        
    },
    async deleteHorario(id){
        try{
            const res = await api.delete("/eliminarHorarios", {data:{id:id}})
        return res.data

        }catch(error){
           const mensajeBackend = error.response?.data?.error || "Error al eliminar el horario";
        console.error("Error backend:", mensajeBackend);
            throw error
        }
        
    },
}
