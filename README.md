# DFS HUB

DFS HUB is a comprehensive learning platform designed for IT-Akademy students, focusing on the Développeur Full Stack (DFS) curriculum and RNCP certification resources. This project is developed as part of the RNCP certification process.

## Project Overview

DFS HUB aims to provide a centralized platform for DFS students to access learning resources, track their progress, and prepare for RNCP certification. The platform is built with a focus on modern web development practices and technologies.

## Key Features

- User Authentication (Local and GitHub OAuth)
- User Profiles with Learning Activity Tracking
- Learning Resource Management (Courses, Tutorials, Articles)
- RNCP Certification Information and Resources
- Personalized Learning Paths
- Q&A Section
- Real-time Collaboration

## Technologies Used

- **Backend Framework**: Symfony 6.2
- **Database**: MySQL
- **ORM**: Doctrine
- **Frontend**: Twig templating engine, JavaScript
- **Authentication**: Symfony Security, KnpU OAuth2 Client Bundle
- **API**: RESTful API with Symfony
- **Real-time Features**: WebSockets (planned)
- **Search**: Elasticsearch (planned)
- **Caching**: Redis (planned)
- **Testing**: PHPUnit

## Technical Details

### Backend Architecture

- MVC architecture using Symfony's best practices
- Doctrine ORM for database interactions
- Custom services for business logic
- Event listeners for specific application events

### Security Measures

- Symfony Security for authentication and authorization
- CSRF protection
- Password hashing using bcrypt
- OAuth2 integration for GitHub login

### Database Design

- Relational database schema optimized for learning resource management
- Entities: User, Course, Lesson, Question, Answer, UserProgress

### API Design

- RESTful API endpoints for resource management
- JWT authentication for API access

### Performance Optimizations

- Doctrine query optimization
- Lazy loading of related entities
- Caching strategies (to be implemented)

### Testing Strategy

- Unit tests for critical business logic
- Functional tests for controllers and API endpoints
- Integration tests for database interactions

## RNCP Certification Relevance

This project demonstrates competencies in:

1. Designing and modeling web applications
2. Developing the frontend and backend of web applications
3. Implementing database design and management
4. Ensuring application security
5. Integrating third-party services (OAuth)
6. Applying best practices in software development

By developing DFS HUB, I aim to showcase my skills as a Full Stack Developer and meet the requirements for RNCP certification.
