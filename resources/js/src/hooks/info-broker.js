import axios from '@/lib/axios'

export const useInfoBroker = () => {
    const csrf = () => axios.get('/sanctum/csrf-cookie')

    const getApiData = async ({ setErrors, setDataHandler, url }) => {
        await csrf()
        setErrors([])
        axios
            .get(url)
            .then((response) => {
                setDataHandler(response.data)
            })
            .catch(error => {
                if (error.response.status !== 422) throw error
                setErrors(error.response.data.errors)
            })
    }

    return {
        getApiData,
    }
}
