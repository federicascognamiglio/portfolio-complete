import { NavLink, Link } from "react-router-dom"
import React, { useEffect, useState } from 'react'
import { useGlobalContext } from "../contexts/GlobalContext"

// Icons
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faBatteryThreeQuarters } from '@fortawesome/free-solid-svg-icons'
import { faWifi } from '@fortawesome/free-solid-svg-icons'

function AppHeader() {
  // Global context variables
  const { categories, types } = useGlobalContext()

  // Show projects dropdown on click
  const [showDropdown, setShowDropdown] = useState(false);
  const [activeClass, setActiveClass] = useState('');

  const handleDropdownToggle = () => {
    setActiveClass(activeClass === 'active' ? '' : 'active');
    setShowDropdown(!showDropdown);
  };

  // Display Date
  const dateDisplay = () => {
    const [formattedDate, setFormattedDate] = useState('');

    useEffect(() => {
      const updateDate = () => {
        const now = new Date();

        const options = {
          weekday: 'short',
          month: 'short',
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit',
          hour12: false,
        };

        const localeString = now.toLocaleString('en-US', options);
        setFormattedDate(localeString.replace(',', ''));
      };

      updateDate();

      const interval = setInterval(updateDate, 60000);

      return () => clearInterval(interval);
    }, []);

    return formattedDate;
  };

  return (
    <header className="header d-flex justify-between align-center text-white">
      <nav className="d-flex align-center">
        <img className="logo" src="/img/scg-logo-white.png" alt="SCG Logo" />
        <ul className="d-flex">
          <li><NavLink className="nav-link" to="/">Home</NavLink></li>
          <li><NavLink className="nav-link" to="/reel">Reel</NavLink></li>
          <li className="p-relative">
            <Link to="/projects/select" className={`nav-link ${activeClass}`} onClick={handleDropdownToggle} >Projects</Link>
            {/* Projects dropdown */}
            {
              showDropdown && (
                <div className="projects-dropdown text-white rounded-lg">
                  <ul>
                    {categories && categories.map(category =>
                      <li key={category.id} className="dropdown-link text-white">
                        <Link className="dropdown-link" to={`/projects?categoryName=${category.name}`} onClick={handleDropdownToggle}>
                          {category.name}
                        </Link>
                      </li>
                    )}
                  </ul>
                </div>
              )
            }
          </li>
          <li><NavLink className="nav-link" to="/about">About</NavLink></li>
        </ul>
      </nav>
      <div className="nav-icons">
        <ul className="d-flex">
          <li><FontAwesomeIcon icon={faBatteryThreeQuarters} /></li>
          <li><FontAwesomeIcon icon={faWifi} /></li>
          <li>{dateDisplay()}</li>
        </ul>
      </div>
    </header>
  )
}

export default AppHeader