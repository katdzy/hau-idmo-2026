<?php

namespace Database\Seeders;

use App\Models\Subjects;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subjects::create([
            'subj_id'=> '1001',
            'subj_code'=> '6DSAL',
            'subj_title'=> 'Data Structures and Algorithms', 
            'subj_description'=> 'The course covers the standard data representation and algorithms to solve computing problems efficiently (with respect to space requirements and time complexity of algorithm).',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);


        Subjects::create([
            'subj_id'=> '1002',
            'subj_code'=> '4RIZAL',
            'subj_title'=> 'Life and Works of Rizal', 
            'subj_description'=> 'As mandated by Republic Act 1425, this course covers the life and works of the country\’s national hero, Jose Rizal.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1003',
            'subj_code'=> '6CISTUDY2',
            'subj_title'=> 'CS Independent Study 2', 
            'subj_description'=> 'This course is a continuation of 6CISTUDY1. This course requires students to undergo final oral defense for their Thesis Project.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1004',
            'subj_code'=> '6ANIMPROD',
            'subj_title'=> 'Animation Design and Production', 
            'subj_description'=> 'In this course, students do collaborative work with each other to design and produce a short animation project given a complete storyboard to work on.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1005',
            'subj_code'=> '1LIT12',
            'subj_title'=> 'Great Books', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1006',
            'subj_code'=> '6BLOCKTECH',
            'subj_title'=> 'Blockchain Technology', 
            'subj_description'=> 'This course explores the fundamentals of the public, transparent, secure, immutable and distributed database called block chain.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1007',
            'subj_code'=> '6COMETHICS',
            'subj_title'=> 'Ethics for Computing Professionals', 
            'subj_description'=> 'In this course, the students will learn about ethical problems that computing professional face, the codes of ethics of computing professional societies, legal issues involved in technology, and the social implications of computers, computing, and other digital technologies.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1008',
            'subj_code'=> '6CLOUDCOM',
            'subj_title'=> 'Cloud Computing', 
            'subj_description'=> 'The course introduces students to cloud computing concepts of how and why cloud systems work and the different cloud technologies and services.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1009',
            'subj_code'=> '6ANIMCAP2',
            'subj_title'=> 'Capstone Project 2 for Animation', 
            'subj_description'=> 'This course requires students to undergo final oral defense for their Capstone Project.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1010',
            'subj_code'=> '4CONWORLD',
            'subj_title'=> 'The Contemporary World', 
            'subj_description'=> 'This course introduces students to the contemporary world by examining the multifaceted phenomenon of globalization.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1011',
            'subj_code'=> '4ARTAPP',
            'subj_title'=> 'Art Appreciation', 
            'subj_description'=> 'Art Appreciation is a three-unit course that develops students’ ability to appreciate, analyse, and critique works of art.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1012',
            'subj_code'=> '2MATHMWORLD',
            'subj_title'=> 'Mathematics in the Modern World', 
            'subj_description'=> 'This course deals with nature of mathematics, appreciation of its practical, intellectual, and aesthetic dimensions, and application of mathematical tools in daily life.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1013',
            'subj_code'=> '2LINALGEB',
            'subj_title'=> 'Linear Algebra', 
            'subj_description'=> 'The course determinants, linear spaces, systems of linear equations, linear functions of a vector argument, coordinate transformations, the canonical form of the matrix of a linear operator, bilinear and quadratic forms, Euclidean spaces, unitary spaces, quadratic form in Euclidean and unitary spaces, finite dimensional space.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1014',
            'subj_code'=> 'THEOLOGY101',
            'subj_title'=> 'Theological Foundations: Judeo-Christian Tradition and Sacred Scriptures', 
            'subj_description'=> 'This foundational course in theology is designed to equip the students with the basic knowledge in the study of Judeo-Christian Tradition and Sacred Scriptures based on the Second Vatican Council which are fundamental foundations in Catholic Faith.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1015',
            'subj_code'=> '6LOGPROG',
            'subj_title'=> 'Logic Formulation and Introductory Programming', 
            'subj_description'=> 'The course covers the use of general purpose programming language to solve problems.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1016',
            'subj_code'=> '6OPSYSFUN',
            'subj_title'=> 'Operating Systems Fundamentals', 
            'subj_description'=> 'Through this course, students will be introduced to what operating systems are, what they do, how they do it, how their performance can be evaluated, and how they compare with each other.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1017',
            'subj_code'=> '6WEBCS',
            'subj_title'=> 'Introduction to Web Programming for CS', 
            'subj_description'=> 'The course provides an overview of web page design foundations, cascading style sheets, and java script.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1018',
            'subj_code'=> '6INTROWEB',
            'subj_title'=> 'Introduction to Web Programming', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1019',
            'subj_code'=> '6OJT',
            'subj_title'=> 'On-the-Job Training (486 hours)', 
            'subj_description'=> 'This course exposes students to a real workplace where they can explore and apply the theories and skills gained from school.',
            'units'=> 6,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1020',
            'subj_code'=> '7TPE1',
            'subj_title'=> 'Physical Activities Toward Health and Fitness 1: Movement Competency Training', 
            'subj_description'=> 'This course reintroduces the fundamental movement patterns that consist of non-locomotor, locomotor skills, which are integrated with core training to meet the demands of functional fitness and physical activity performance.',
            'units'=> 2,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1021',
            'subj_code'=> '4UNDERSELF',
            'subj_title'=> 'Understanding the Self', 
            'subj_description'=> 'This course is intended to facilitate the exploration of the issues and concerns regarding self and identity to arrive at a better understanding of one\’s self.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1022',
            'subj_code'=> '6SOPMAN',
            'subj_title'=> 'Sound Production Management', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1023',
            'subj_code'=> '4ETHICS',
            'subj_title'=> 'Ethics', 
            'subj_description'=> ' The course discusses the context and principles of ethical behavior in modern society at the level of individual, society, and in interaction with the environment and other shared resources.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1024',
            'subj_code'=> '9STS',
            'subj_title'=> 'Science, Technology, and Society', 
            'subj_description'=> 'The course deals with interactions between science and technology and social, cultural, political, and economic contexts that shape and are shaped by them.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1025',
            'subj_code'=> '6SRWE',
            'subj_title'=> 'Switching, Routing, and Wireless Essentials', 
            'subj_description'=> 'The course focuses on the advance routing and switching services and operations of routers and switches.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1026',
            'subj_code'=> '6SHWINT',
            'subj_title'=> 'Software and Hardware Interfacing', 
            'subj_description'=> 'This course familiarizes students with the basic electronic components and their functions such as resistors, push button switches, LEDs and 74 series family of logic gates.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1027',
            'subj_code'=> '6IOT',
            'subj_title'=> 'Internet of Things', 
            'subj_description'=> 'This specialized course is designed to clear your concepts in embedded systems & IoT using complete practical approach.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1028',
            'subj_code'=> '6SERVERSEC1',
            'subj_title'=> 'Server Administration and Security 1', 
            'subj_description'=> 'This course explores the design and building of Windows Sever system in an enterprise environment.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1029',
            'subj_code'=> '6MODRIG',
            'subj_title'=> 'Modeling and Rigging', 
            'subj_description'=> 'In this course, students learn how to develop character assets in varied gradients of detail based on given concept arts.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1030',
            'subj_code'=> '6ADVAN2D',
            'subj_title'=> 'Advanced 2D Animation', 
            'subj_description'=> 'This course builds on the principles of 2D animation. Advanced techniques in preparing 2D animation assets for use in various multimedia outputs and projects will be covered including automatic generation of 2D animation and assets through programming through scripting.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1031',
            'subj_code'=> '6OJT-EMC',
            'subj_title'=> 'Internship/OJT (486 hours)', 
            'subj_description'=> 'This course exposes students to a real workplace where they can explore and apply the theories and skills gained from school.',
            'units'=> 9,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1032',
            'subj_code'=> '4FYE1',
            'subj_title'=> 'Big History 1: Big Bang to the Future', 
            'subj_description'=> 'Big History is an interdisciplinary course that deals with the students\’ journey through time and space with the Catholic intellectual tradition as an integral component of the course.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1033',
            'subj_code'=> '7TPE3',
            'subj_title'=> 'Select Physical Activities Toward Health and Fitness 3', 
            'subj_description'=> 'This course provides selection of physical activities (PA) for the purpose of optimizing health and fitness.',
            'units'=> 2,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1034',
            'subj_code'=> '6ITPROGMAN',
            'subj_title'=> 'Project Management', 
            'subj_description'=> 'This course provides students with an understanding of the theory and practice of project management through an integrated view of the concepts, skills tools and techniques involved in the management of information systems development projects.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1035',
            'subj_code'=> '6IASEC',
            'subj_title'=> 'Information Assurance and Security', 
            'subj_description'=> 'This course focuses on the fundamentals of information security that are used in protecting both the information present in computer storage as well as information traveling over computer networks.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1036',
            'subj_code'=> '6OOP',
            'subj_title'=> 'Object Oriented Programming', 
            'subj_description'=> 'The course teaches the object-oriented programming principles with a focus on software design and code reuse.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1037',
            'subj_code'=> '6WCAP2',
            'subj_title'=> 'Web Development Capstone 2', 
            'subj_description'=> 'This course enables the student to learn and understand the concepts of methods of research and application in information technology projects particularly in the field of Web Development.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1038',
            'subj_code'=> '6CRYPTOGRAPHY',
            'subj_title'=> 'Applied Cryptography', 
            'subj_description'=> 'This course covers fundamentals of protecting confidentiality, integrity and availability of information in computer systems through application of cryptographic concepts and methods.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1039',
            'subj_code'=> '6ADET',
            'subj_title'=> 'Application Development and Emerging Technologies', 
            'subj_description'=> 'Development of applications using web, mobile, and emerging technologies with emphasis on requirements management, interface design, usability, testing, deployment, including ethical and legal considerations.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1040',
            'subj_code'=> '6COMGRAP',
            'subj_title'=> 'Computer Graphics Programming', 
            'subj_description'=> 'This course covers the fundamental concepts in creating graphical images on the computer.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1041',
            'subj_code'=> '6IGAME',
            'subj_title'=> 'Introduction to Game Design and Development', 
            'subj_description'=> 'The course gives an overview of the game development process from conception to production.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1042',
            'subj_code'=> '6CFUN',
            'subj_title'=> 'Computing Fundamentals', 
            'subj_description'=> 'This course provides an overview of the Computing Industry and Computing profession.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1043',
            'subj_code'=> '4READPHILHIS',
            'subj_title'=> 'Readings in Philippine History', 
            'subj_description'=> 'The course analyses Philippine history from multiple perspectives through the lens of selected primary sources coming from various disciplines and of different genres.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1044',
            'subj_code'=> '6IVPROL',
            'subj_title'=> 'Image and Video Processing', 
            'subj_description'=> 'In this course, students learn the fundamental operations on images and videos.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1045',
            'subj_code'=> '6OSAPP',
            'subj_title'=> 'Operating Systems Application', 
            'subj_description'=> 'This course introduces concepts of Operating Systems and their applications using Linux that focus on the installation, package management, user management, file system management, network administration, printers and services, maintenance and troubleshooting of Linux systems.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1046',
            'subj_code'=> '6SERVERMAN',
            'subj_title'=> 'Advance Server Management', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1047',
            'subj_code'=> 'CWTS1',
            'subj_title'=> 'Civic Welfare Training Services 1', 
            'subj_description'=> 'The Literacy Training Service I (LTS1), Civic Welfare Training Service (CWTS1) and Reserved Officer Training Course (ROTC1) are components of the university NSTP1 Program that aim to prepare students for NSTP2 or application phase by providing them the basic concepts and theories needed for doing community work.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1048',
            'subj_code'=> '6EMC',
            'subj_title'=> 'Introduction to Entertainment and Multimedia Computing', 
            'subj_description'=> 'This course provides an overview of the Computing Industry and Computing Profession in Entertainment, and Multimedia applications',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1049',
            'subj_code'=> '6ANIMCAP1',
            'subj_title'=> 'Capstone Project 1 for Animation', 
            'subj_description'=> 'This course enables the student to learn and understand the concepts of methods of research and application in information technology projects particularly in the field of Animation.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1050',
            'subj_code'=> '6CYBERPOLICY',
            'subj_title'=> 'Cybersecurity and Privacy: Law, Policies, and Compliance', 
            'subj_description'=> 'This course covers the understanding of cybersecurity policies that offers a comprehensive view of information security policies applied in the business context and examine the law and policy of foreign and domestic Internet governance, computer crime, online privacy and personal data protection, private infrastructure and the law of emergencies, and emerging compliance frameworks for cybersecurity.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1051',
            'subj_code'=> '6WCSERVER',
            'subj_title'=> 'Web Server and Client Services', 
            'subj_description'=> 'This course provides emphasis in setting up web services using server-side technologies and establishes interoperability with the different client-side components, integrate database access, and implement web security protocols and techniques',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1052',
            'subj_code'=> '6INFOR',
            'subj_title'=> 'Introduction to Network Forensics', 
            'subj_description'=> 'This class is an introduction to the concepts of forensic science of gathering digital evidence in network intrusion and information security.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1053',
            'subj_code'=> '2PROBSTAT',
            'subj_title'=> 'Probability and Statistics', 
            'subj_description'=> 'The course covers the definition, history and uses of statistics, collection of data and presentation of the data gathered.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1054',
            'subj_code'=> '6DRAW2',
            'subj_title'=> 'Principles of 2D Animation', 
            'subj_description'=> 'The course introduces the standards and common practice for traditional animation, wherein students would know the core skills of animation in relation to drawing either on a traditional platform or digital.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1055',
            'subj_code'=> '6WEBPUB',
            'subj_title'=> 'Web and Advertising Publishing Concepts', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1056',
            'subj_code'=> '1TWRITE-ITE',
            'subj_title'=> 'Technical Writing for Information Technology Education', 
            'subj_description'=> 'This course is designed to train students in writing technical reports and documents such as business letters and research papers.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1057',
            'subj_code'=> '6NSEC',
            'subj_title'=> 'Network Security Implementation', 
            'subj_description'=> 'This is course is a hands-on, career-oriented e-learning solution with an emphasis on practical experience to help students develop special skills to advance their careers.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1058',
            'subj_code'=> '6ICYBER',
            'subj_title'=> 'Introduction to Cyber Security & Emerging Technology & Threats to Cyber Security', 
            'subj_description'=> 'This course helps the learner to have deeper understanding of modern information and system protection technology and methods.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1059',
            'subj_code'=> '6COARC',
            'subj_title'=> 'Computer Architecture and Organization', 
            'subj_description'=> 'This course is designed to provide students with an introductory but comprehensive knowledge on the evolution of computer systems in terms of its hardware component in connection to its software implementation',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1060',
            'subj_code'=> '2INTCALC',
            'subj_title'=> 'Integral Calculus', 
            'subj_description'=> 'Concept of integration and its application to physical problems such as evaluation of areas, volumes of revolution, force, and work',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1061',
            'subj_code'=> '2CALC-IT',
            'subj_title'=> 'Calculus', 
            'subj_description'=> 'The course provides students with experiences on solving problem that require the interpretation of algebra and geometric concepts and the fundamental concepts of Differential and integral Calculus',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1062',
            'subj_code'=> '6ACLOUD',
            'subj_title'=> 'Advance Cloud Computing for Cybersecurity', 
            'subj_description'=> 'This course will introduce industry best practices for cloud security and learn how to architect and configure security-related features in a cloud platform.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1063',
            'subj_code'=> '6CYBERCAP1',
            'subj_title'=> 'Capstone for Cybersecurity 1', 
            'subj_description'=> 'Capstone Project 1, it deals with principles of research as applied to information technology, types of researches, methodologies, research formats, technical writing styles and writing research proposals.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1064',
            'subj_code'=> '6WDCAP1',
            'subj_title'=> 'Web Development Capstone 1', 
            'subj_description'=> 'This course enables the student to learn and understand the concepts of methods of research and application in information technology projects particularly in the field of Web Development.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1065',
            'subj_code'=> '6ATF',
            'subj_title'=> 'Automata Theory and Formal Languages', 
            'subj_description'=> 'This course covers the following topics: regular languages, finite automata, determinism and non-determinism in finite automata, applications to searching and pattern matching, context-free languages, push-down automata, applications to compiler design and computability theory',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1066',
            'subj_code'=> '6ADMATHS',
            'subj_title'=> 'Advanced Discrete Mathematics and Structures', 
            'subj_description'=> 'This course focuses on the advanced topics of discrete mathematics, which are categorized in the following areas: Counting, Permutations, Combinations, Recurrence Algorithms, Probability and Naïve Bayes Theorem.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1067',
            'subj_code'=> '6ADDBASE',
            'subj_title'=> 'Advanced Database Systems', 
            'subj_description'=> 'The course will provide the student with an understanding of the principles of Database Administration Fundamentals and covers introductory knowledge and skills.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1068',
            'subj_code'=> '9PHYSICS-A',
            'subj_title'=> 'Physics for Animation', 
            'subj_description'=> '',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1069',
            'subj_code'=> '9CALBPHYS',
            'subj_title'=> 'Calculus-based Physics', 
            'subj_description'=> 'The course covers the study of mechanics, waves, sound and heat.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1070',
            'subj_code'=> '9CALBPHYSL',
            'subj_title'=> 'Calculus-based Physics Laboratory', 
            'subj_description'=> 'This course is designed for students in the taking up the fundamental concepts of Physics',
            'units'=> 1,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1071',
            'subj_code'=> '6IMSOFTENG',
            'subj_title'=> 'Implementation and Management of Software Engineering', 
            'subj_description'=> 'The course introduces the fundamental principles of Software Engineering. It covers the study of software structure, designs and types along with the underlying Software Engineering Ethics.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1072',
            'subj_code'=> '6SSAD',
            'subj_title'=> 'Systems Analysis and Design', 
            'subj_description'=> 'This course introduces the tools and techniques commonly used by systems analysts in designing, building and documenting information systems.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1073',
            'subj_code'=> '6IMODSIM',
            'subj_title'=> 'Introduction to Modelling and Simulation', 
            'subj_description'=> 'This course familiarizes simulation built using these four principal components; namely, (a) domain expertise, (b) data collection and treatment, (c) mathematical modeling strategies, and (d) simulation system methodologies (including technology)',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1074',
            'subj_code'=> '6ETHACKING',
            'subj_title'=> 'Ethical Hacking and Countermeasures', 
            'subj_description'=> 'This course develops problem solving skills of IT security professionals in detecting weaknessesof network infrastructures from a hacker\’s perspective',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1075',
            'subj_code'=> '6UHCID',
            'subj_title'=> 'Usability, HCI and User Interaction Design', 
            'subj_description'=> 'The course focuses on imparting to students the techniques in making software more intuitive to use and hence making it easy for target users to learn its fundamental functions and features.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1076',
            'subj_code'=> '6WEBTECHL',
            'subj_title'=> 'Web Technologies', 
            'subj_description'=> 'This course is designed to provide a thorough working knowledge in defining content of web pages using Hypertext Markup Language 5 (HTML 5) integrated with creative layout using CSS3 (Cascading Style Sheet 3)',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1077',
            'subj_code'=> '6DESPRO',
            'subj_title'=> 'Design and Production Process', 
            'subj_description'=> 'This course covers the design and production process in the field of animation.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1078',
            'subj_code'=> '6ENCREA',
            'subj_title'=> 'Entrepreneurship for the Creative', 
            'subj_description'=> 'This course introduces students the creativity concepts in entrepreneurship and its importance.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1079',
            'subj_code'=> '6NETCAP1',
            'subj_title'=> 'Network Independent Study 1', 
            'subj_description'=> 'The course applies the knowledge and skills acquired from the networking course to complete a study.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1080',
            'subj_code'=> '6WDCAP2',
            'subj_title'=> 'Web Development Capstone 2', 
            'subj_description'=> 'This course enables the student to learn and understand the concepts of methods of research and application in information technology projects particularly in the field of Web Development.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

        Subjects::create([
            'subj_id'=> '1081',
            'subj_code'=> '6CLOUDSEC',
            'subj_title'=> 'Cloud Computing for Cybersecurity', 
            'subj_description'=> 'The course introduces students to cloud computing concepts of how and why cloud systems work, as well as the different cloud technologies and services.',
            'units'=> 3,
            'subj_sy'=> '2024-2025'
        ]);

    }
}