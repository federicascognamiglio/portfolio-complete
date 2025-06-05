import { useLocation, useNavigate } from "react-router-dom";
import { useGlobalContext } from "../contexts/GlobalContext";
import { useEffect, useState } from "react";
import axios from "axios";
import ProjectsGrid from "../components/ProjectsGrid";
import ProjectsPreview from "../components/ProjectsPreview";

// Icons
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
import { faTableCellsLarge } from '@fortawesome/free-solid-svg-icons'
import { faGripVertical } from '@fortawesome/free-solid-svg-icons'
import { faFilter } from '@fortawesome/free-solid-svg-icons'
import { faXmark } from "@fortawesome/free-solid-svg-icons";
import { faMinus } from "@fortawesome/free-solid-svg-icons";
import { faUpRightAndDownLeftFromCenter } from "@fortawesome/free-solid-svg-icons";

function ProjectsPage() {
    //Navigate
    const navigate = useNavigate();
    const location = useLocation();

    // Get params
    const queryParams = new URLSearchParams(location.search);
    const categoryParam = queryParams.get("categoryName");

    // State Variables
    const [projects, setProjects] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(categoryParam)
    const [selectedType, setSelectedType] = useState('')

    // Global Context Variables
    const { categories, baseApiUrl } = useGlobalContext();

    // Get Projects
    const getProjects = ({ category, type }) => {
        const url = new URL(`${baseApiUrl}/projects`);
        if (category) url.searchParams.append("category_name", category);
        if (type) url.searchParams.append("type_name", type);
        axios.get(url.toString())
            .then(resp => setProjects(resp.data.data))
            .catch(err => console.error("Error loading projects:", err));
    };

    // Load projects when component mounts
    useEffect(() => {
        if (selectedType) {
            getProjects({ type: selectedType });
        } else if (selectedCategory) {
            getProjects({ category: selectedCategory });
        }
    }, [selectedCategory, selectedType]);

    // Handle Category Click
    const handleCategoryClick = (categoryName) => {
        setSelectedType('')
        setSelectedCategory(categoryName);
        navigate(`?categoryName=${categoryName}`, { state: { fromProjectsPage: true } });
    };

    // Handle Type Click
    const handleTypeClick = (typeName) => {
        setSelectedCategory('')
        setSelectedType(typeName);
        navigate(`?typeName=${typeName}`, { state: { fromProjectsPage: true } });
    };

    // Handle Back and Forward navigation
    const [canGoBack, setCanGoBack] = useState(false);
    const [canGoForward, setCanGoForward] = useState(false);

    useEffect(() => {
        // Check if can go back or forward in Projects Page
        const { state } = location;

        if (state && state.fromProjectsPage) {
            setCanGoBack(true);
        } else {
            setCanGoBack(false);
        }

        setCanGoForward(true);
    }, [location]);

    // Navigate Back
    const handleBack = () => {
        if (canGoBack) {
            navigate(-1);
        }
    };

    // Navigate Forward
    const handleForward = () => {
        if (canGoForward) {
            navigate(1);
        }
    };

    // Update selectedCategory and selectedType when location changes
    useEffect(() => {
        const queryParams = new URLSearchParams(location.search);
        const categoryFromUrl = queryParams.get("categoryName");
        const typeFromUrl = queryParams.get("typeName");

        if (categoryFromUrl && categoryFromUrl !== selectedCategory) {
            setSelectedCategory(categoryFromUrl);
            setSelectedType('')
        }
        if (typeFromUrl && typeFromUrl !== selectedType) {
            setSelectedCategory('')
            setSelectedType(typeFromUrl);
        }
    }, [location]);

    // Grid Switch Handler
    const [gridType, setGridType] = useState("grid");
    const handleGridSwitch = (type) => {
        setGridType(type);
    }

    return (
        <div className="projects-page text-white">
            <div className="d-flex">
                {/* Side Menu */}
                <div className="side-menu">
                    {/* Buttons */}
                    <div className="side-menu-header p-relative d-flex align-center justify-center">
                        <a href="/" className="close-btn d-flex align-center justify-center">
                            <FontAwesomeIcon icon={faXmark} className="btn-icon d-none" style={{ color: '#5d0605' }} />
                        </a>
                        <button className="hide-btn d-flex align-center justify-center">
                            <FontAwesomeIcon icon={faMinus} className="btn-icon d-none" style={{ color: '#504700' }} />
                        </button>
                        <button className="expand-btn d-flex align-center justify-center">
                            <FontAwesomeIcon icon={faUpRightAndDownLeftFromCenter} className="btn-icon d-none" style={{ color: '#012f0d', fontSize: '.4rem' }} />
                        </button>
                    </div>
                    {/* Categories */}
                    <div className="side-menu-body">
                        {categories && categories.map(category => (
                            <div key={category.id} className="side-menu-elements">
                                <p onClick={() => handleCategoryClick(category.name)} className={`category-item ${category.name === selectedCategory ? "active-side-bar" : ""}`}>
                                    {category.name}
                                </p>
                                {/* Types */}
                                <div className="side-menu-types">
                                    {category.types && category.types.map(type => (
                                        <p onClick={() => handleTypeClick(type.name)} key={type.id} className={`type-item ${type.name === selectedType ? "active-side-bar" : ""}`}>
                                            {type.name}
                                        </p>
                                    ))}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
                {/* Projects List */}
                <div className="projects-list">
                    {/* Header */}
                    <div className="projects-list-header p-relative d-flex align-center justify-between">
                        <div className="navigation">
                            <button
                                className={`back-btn ${!canGoBack ? 'disabled' : ''}`}
                                onClick={handleBack}
                                disabled={!canGoBack}>
                                &lt;
                            </button>
                            <button
                                className={`forward-btn ${!canGoForward ? 'disabled' : ''}`}
                                onClick={handleForward}
                                disabled={!canGoForward}>
                                &gt;
                            </button>
                            <span className="category-name">{selectedCategory || selectedType}</span>
                        </div>
                        <div className="actions d-flex">
                            <div className="buttons">
                                <button onClick={() => handleGridSwitch('grid')} className="layout-grid grid-icon p-relative"><FontAwesomeIcon icon={faTableCellsLarge} /></button>
                                <button onClick={() => handleGridSwitch('preview')} className="layout-list grid-icon"><FontAwesomeIcon icon={faGripVertical} /></button>
                                <button className="filters-btn grid-icon p-relative"><FontAwesomeIcon icon={faFilter} /></button>
                            </div>
                            <div className="p-relative">
                                <input type="text" className="search-bar" />
                                <FontAwesomeIcon icon={faMagnifyingGlass} className="search-bar-icon" />
                            </div>
                        </div>
                    </div>
                    {gridType === 'grid' && <ProjectsGrid projects={projects} />}
                    {gridType === 'preview' && <ProjectsPreview projects={projects} />}
                </div>
            </div>
        </div >
    )
}

export default ProjectsPage;