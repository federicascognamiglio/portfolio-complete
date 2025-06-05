import { BrowserRouter, Routes, Route } from "react-router-dom"

// Layouts
import MainLayout from "./layouts/MainLayout"

// Contexts
import { GlobalContextProvider } from "./contexts/GlobalContext"

// Pages
import HomePage from "./pages/HomePage"
import ReelPage from "./pages/ReelPage"
import ProjectsPage from "./pages/ProjectsPage"
import AboutPage from "./pages/AboutPage"
import DetailPage from "./pages/DetailPage"
import CvPage from "./pages/CvPage"

function App() {

  return (
    <>
      <GlobalContextProvider>
        <BrowserRouter>
          <Routes>
            <Route element={<MainLayout />} >
              <Route index element={<HomePage />} />
              <Route path="/reel" element={<ReelPage />} />
              <Route path="/cv" element={<CvPage />}/>
              <Route path="/projects/select" element={<HomePage />} />
              <Route path="/projects" element={<ProjectsPage />} />
              <Route path="/about" element={<AboutPage />} />
              <Route path="/detail/:slug" element={<DetailPage />} />
            </Route>
          </Routes>
        </BrowserRouter>
      </GlobalContextProvider>
    </>
  )
}

export default App
