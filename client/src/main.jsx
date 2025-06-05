import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './style/fonts.css'
import './style/utilities.css'
import './style/common.css'
import './style/hover.css'
import './style/index.css'
import App from './App.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <App />
  </StrictMode>,
)
