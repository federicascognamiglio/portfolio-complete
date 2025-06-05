import { useState, useEffect, createContext, useContext } from "react"
import axios from 'axios'

const GlobalContext = createContext()

function GlobalContextProvider({ children }) {

    // URL
    const baseApiUrl = import.meta.env.VITE_API_URL
    const baseImgUrl = import.meta.env.VITE_IMG_URL

    // Categories
    const [categories, setCategories] = useState([])

    const getCategories = () => {
        axios.get(baseApiUrl + '/categories').then(resp => {
            const data = resp.data.data
            setCategories(data)
        })
    }

    useEffect(() => {
        getCategories()
    }, [])

    const providerValue = { categories, baseApiUrl, baseImgUrl }

    return (
        <GlobalContext.Provider value={providerValue}>
            {children}
        </GlobalContext.Provider>
    )

}

function useGlobalContext() {
    return useContext(GlobalContext)
}

export { GlobalContextProvider, useGlobalContext }
