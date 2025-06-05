import { useGlobalContext } from "../contexts/GlobalContext";

function ProjectsGrid({ projects }) {
    // Global Context Variables
    const { baseImgUrl } = useGlobalContext();
    return (
        <>
            {/* Body */}
            <div className="projects-list-body project-grid d-flex">
                <div className="row">
                    {projects && projects.map(project => (
                        <div className="col-10" key={project.id}>
                            <a href={`/detail/${project.slug}`} className="project-card grid-card d-flex flex-column justify-center align-center">
                                <div className="project-thumbnail">
                                    <img src={`${baseImgUrl}/${project.cover_image}`} alt={`${project.name} thumbnail`} className="thumbnail-img rounded" />
                                </div>
                                <h5 className="project-name">{project.title}</h5>
                            </a>
                        </div>
                    ))}
                </div>
            </div>
        </>
    )
}

export default ProjectsGrid;