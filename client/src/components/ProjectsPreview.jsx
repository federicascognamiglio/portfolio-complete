import React, { useEffect, useState } from 'react';
import { useGlobalContext } from '../contexts/GlobalContext';
import axios from 'axios';

function ProjectsPreview({ projects }) {
    // Global Context Variables
    const { baseApiUrl, baseImgUrl } = useGlobalContext();

    // State Variables
    const [selectedProject, setSelectedProject] = useState(null);

    // Preview Project
    const getProjectToPreview = (slug) => {
        axios.get(`${baseApiUrl}/projects/${slug}`)
            .then(resp => {
                setSelectedProject(resp.data.data);
            })
            .catch(err => {
                console.error('Error fetching project data:', err);
            });
    }

    useEffect(() => {
        if (projects.length > 0) {
            getProjectToPreview(projects[0].slug);
        }
    }, [projects]);

    // Highlight the selected project
    const isHigligthed = (project) => {
        return selectedProject && selectedProject.id === project.id ? 'highlighted' : '';
    }

    return (
        <div className="projects-list-body">
            <div className="row">
                <div className="col-list">
                    <div className="row">
                        {projects && projects.map(project => (
                            <div className={`col ${isHigligthed(project)}`} key={project.id}>
                                <div onClick={() => getProjectToPreview(project.slug)} className="project-card d-flex align-center">
                                    <div className="project-thumbnail-sm">
                                        <img src={`${baseImgUrl}/${project.cover_image}`} alt={`${project.name} thumbnail`} className="thumbnail-img rounded" />
                                    </div>
                                    <h5 className="project-name">{project.title}</h5>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
                {selectedProject &&
                    <div className="col-preview">
                        <div className="project-preview-card">
                            <div className="project-preview-thumbnail">
                                <img src={`${baseImgUrl}/${selectedProject.cover_image}`} alt={`${selectedProject.name} thumbnail`} className="thumbnail-img rounded" />
                            </div>
                            <div className="project-preview-details">
                                <h5 className="project-preview-name">{selectedProject.title}</h5>
                                <p className='project-preview-subtitle'>{selectedProject.subtitle}</p>
                                <p>Information:</p>
                                <div className="project-preview-info">
                                    <div className="info-row d-flex justify-between align-center">
                                        <p>Client:</p>
                                        <p>{selectedProject.client ? selectedProject.client : 'Personal Project'}</p>
                                    </div>
                                    <hr className='divider' />
                                    <div className="info-row d-flex justify-between align-center">
                                        <p>Tags:</p>
                                        <p>{selectedProject.tags && selectedProject.tags.map((tag, index) => (
                                            <span key={tag.id} className="tag">{index === 0 ? tag.name : `, ${tag.name}`}</span>
                                        ))}</p>
                                    </div>
                                    <hr className='divider' />
                                    <div className="info-row d-flex justify-between align-center">
                                        <p>Tools:</p>
                                        <p>{selectedProject.tools && selectedProject.tools.map((tool, index) => (
                                            <span key={tool.id} className="tool">{index === 0 ? tool.name : `, ${tool.name}`}</span>
                                        ))}</p>
                                    </div>
                                </div>
                                <div className='d-flex flex-column align-center'>
                                    <a className="more-btn p-relative" href={`detail/${selectedProject.slug}`}>
                                        <span className="dots">&hellip;</span>
                                    </a>
                                    <p>Details</p>
                                </div>
                            </div>
                        </div>
                    </div>
                }
            </div>
        </div>
    );
}

export default ProjectsPreview;