CREATE TABLE Employers(
    emp_id INT PRIMARY KEY,
    department_name varchar(500),
    emp_position varchar(500),
    contact_email varchar(500)
    );

    CREATE TABLE JobPostings(
        job_id INT PRIMARY KEY,
        emp_id INT,
        title varchar(500),
        job_description text,
        posted_date date,
deadline date,
foreign key (emp_id) referemces Employers(emp_id)
    );

CREATE TABLE Candidates(
    Candidate_id INT primary key,
    first_name varchar(500),
    surname varchar(500),
    email varchar(500),
    phone_number varchar(20),
    resume text
);

CREATE TABLE Applications (
    application_id INT PRIMARY KEY,
    job_id INT,
    candidate_id INT,
    application_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (job_id) REFERENCES JobPostings(job_id),
    FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id)
);

CREATE TABLE Skills (
    skill_id INT PRIMARY KEY,
    skill_name VARCHAR(100)
);

CREATE TABLE Education (
    education_id INT PRIMARY KEY,
    candidate_id INT,
    institution VARCHAR(255),
    degree VARCHAR(100),
    major VARCHAR(100),
    graduation_year INT,
    FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id)
);

CREATE TABLE WorkExperience (
    experience_id INT PRIMARY KEY,
    candidate_id INT,
    company_name VARCHAR(255),
    position VARCHAR(100),
    start_date DATE,
    end_date DATE,
    description TEXT,
    FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id)
);

cREATE TABLE Interviews (
    interview_id INT PRIMARY KEY,
    application_id INT,
    interview_date DATETIME,
    interview_location VARCHAR(255),
    feedback TEXT,
    FOREIGN KEY (application_id) REFERENCES Applications(application_id)
);

CREATE TABLE JobCategories (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(100)
);

CREATE TABLE JobCategoryMapping (
    job_id INT,
    category_id INT,
    PRIMARY KEY (job_id, category_id),
    FOREIGN KEY (job_id) REFERENCES JobPostings(job_id),
    FOREIGN KEY (category_id) REFERENCES JobCategories(category_id)
);


CREATE TABLE HRManager (
    hr_manager_id INT PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(100),
    -- Other HR Manager details
);

CREATE TABLE RecruitmentSystem (
    recruitment_system_id INT PRIMARY KEY,
    system_name VARCHAR(255),
    -- Other Recruitment System details
);

CREATE TABLE JobVacancy (
    vacancy_id INT PRIMARY KEY,
    job_title VARCHAR(255),
    vacancy_details TEXT,
    posted_date DATE,
    deadline DATE,
    hr_manager_id INT,
    FOREIGN KEY (hr_manager_id) REFERENCES HRManager(hr_manager_id)
);


CREATE TABLE ShortlistedCandidate (
    shortlist_id INT PRIMARY KEY,
    application_id INT,
    -- Other shortlisting details
    FOREIGN KEY (application_id) REFERENCES JobApplication(application_id)
);

CREATE TABLE InterviewAssessment (
    assessment_id INT PRIMARY KEY,
    shortlist_id INT,
    -- Other assessment details
    FOREIGN KEY (shortlist_id) REFERENCES ShortlistedCandidate(shortlist_id)
);

CREATE TABLE CandidateEvaluation (
    evaluation_id INT PRIMARY KEY,
    application_id INT,
    assessment_id INT,
    -- Other evaluation details
    FOREIGN KEY (application_id) REFERENCES JobApplication(application_id),
    FOREIGN KEY (assessment_id) REFERENCES InterviewAssessment(assessment_id)
);

CREATE TABLE JobOffer (
    offer_id INT PRIMARY KEY,
    application_id INT,
    -- Other offer details
    FOREIGN KEY (application_id) REFERENCES JobApplication(application_id)
);

CREATE TABLE RecruitmentReport (
    report_id INT PRIMARY KEY,
    hr_manager_id INT,
    report_date DATE,
    -- Other report details
    FOREIGN KEY (hr_manager_id) REFERENCES HRManager(hr_manager_id)
);

CREATE TABLE JobSeekerProfile (
    job_seeker_id INT PRIMARY KEY,
    -- Other Job Seeker profile details
    FOREIGN KEY (job_seeker_id) REFERENCES JobSeeker(job_seeker_id)
);

CREATE TABLE JobSeekerAccount (
    job_seeker_id INT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255), -- Note: Store securely, consider hashing
    -- Other account details
    FOREIGN KEY (job_seeker_id) REFERENCES JobSeeker(job_seeker_id)
);

CREATE TABLE OnboardingMaterial (
    material_id INT PRIMARY KEY,
    material_name VARCHAR(255),
    -- Other onboarding material details
);

CREATE TABLE Onboarding (
    onboarding_id INT PRIMARY KEY,
    job_seeker_id INT,
    onboarding_date DATE,
    material_id INT,
    -- Other onboarding details
    FOREIGN KEY (job_seeker_id) REFERENCES JobSeeker(job_seeker_id),
    FOREIGN KEY (material_id) REFERENCES OnboardingMaterial(material_id)
);


