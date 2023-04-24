import axios from '@/lib/axios'

export const useInfoBroker = () => {
    const csrf = () => axios.get('/sanctum/csrf-cookie')

    const getApiData = async ({ setErrors, setDataHandler, url}) => {
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

    const getShips = async ({ setErrors, setShips }) => {
        await getApiData({
            setErrors,
            setDataHandler: setShips,
            url: '/api/sw/people/1/starships',
        })
    }

    const getSpecies = async ({ setErrors, setSpecies }) => {
        await getApiData({
            setErrors,
            setDataHandler: setSpecies,
            url: '/api/sw/films/4/species',
        })
    }

    const getPopulation = async ({ setErrors, setPopulation }) => {
        await getApiData({
            setErrors,
            setDataHandler: setPopulation,
            url: '/api/sw/planets/population',
        })
    }

    return {
        getApiData,
        getShips,
        getSpecies,
        getPopulation,
    }
}
