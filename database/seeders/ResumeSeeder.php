<?php

namespace Database\Seeders;

use App\Models\Resume;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resume::truncate();
        Resume::create([
            'title' => 'Default Professional Resume',
            'name' => 'Subhadip Chakraborty',
            'email' => 'subhadip240420@gmail.com',
            'phone' => '6290765575',
            'location' => 'Kolkata, West Bengal',
            'linkedin' => 'linkedin.com/subhadip-chakarborty', // as written in photo
            'website' => 'India', // from the header in the photo
            'is_active' => true,
            'education' => [
                [
                    'institution' => 'Aliah University',
                    'location' => 'Kolkata, West Bengal',
                    'degree' => 'B.Tech In Electronics Communication Engineering (ECE)',
                    'enrolled' => 'Sep 2021',
                    'expected' => 'July 2024',
                    'percentage' => ''
                ],
                [
                    'institution' => 'Ramakrishna Mission Shilpamandira',
                    'location' => 'Kolkata, West Bengal',
                    'degree' => 'Diploma In, Electronics And Telecommunication Engineering (ETCE)',
                    'enrolled' => 'June 2018',
                    'expected' => 'July 2021',
                    'percentage' => '86.00'
                ],
                [
                    'institution' => 'Byadabati Binomali Mukherjee Institution',
                    'location' => 'West Bengal',
                    'degree' => 'Senior Secondary (XII), Science',
                    'enrolled' => '2016',
                    'expected' => '2018',
                    'percentage' => '66.00'
                ],
                [
                    'institution' => 'Singur Mahayana High School',
                    'location' => 'West Bengal',
                    'degree' => 'Secondary (X)',
                    'enrolled' => '',
                    'expected' => '2016',
                    'percentage' => '71.00'
                ]
            ],
            'experience' => [
                [
                    'company' => 'Freelance Software Developer',
                    'location' => 'Kolkata, WB (Remote)',
                    'title' => 'Full Stack Developer',
                    'start_date' => 'Jan 2024',
                    'end_date' => 'Present',
                    'points' => [
                        'Built and deployed secure Laravel web applications for local businesses and startups, enhancing digital presence and search visibility.',
                        'Created structured, automated APIs, integrated payment gateways, and configured email dispatch systems.'
                    ]
                ]
            ],
            'training' => [
                [
                    'organization' => 'South Eastern Railway(ST)',
                    'location' => 'Kharagpur, WB',
                    'title' => 'Vocational Training',
                    'start_date' => 'Aug 2023',
                    'end_date' => 'sep 2023'
                ],
                [
                    'organization' => 'Flynn Labs',
                    'location' => 'Onlines',
                    'title' => 'Machine Learning Internship',
                    'start_date' => 'June 2023',
                    'end_date' => 'Aug 2023'
                ],
                [
                    'organization' => 'Prasar Bharati(India\'s Public Service Broadcaster)',
                    'location' => 'Kolkata, WB',
                    'title' => 'Vocational Training',
                    'start_date' => 'Aug 2022',
                    'end_date' => 'Aug 2022'
                ]
            ],
            'projects' => [
                [
                    'title' => 'Heart Disease Prediction Web App',
                    'link' => 'https://github.com/Subhadip023/heart-disease-web-app',
                    'points' => [
                        'Built with Flask, this web application enables users to input key health metrics and predicts the likelihood of heart disease. Users provide details such as age, blood pressure, cholesterol levels, and exercise habits. The application processes this data using a pre-trained machine learning model and displays the prediction on the user interface. With a simple and intuitive design, the app offers quick insights into heart health, aiding users in proactive health management. Implemented using Python, HTML, CSS, and JavaScript, the app provides accurate and instant predictions, promoting heart disease awareness and prevention.'
                    ]
                ],
                [
                    'title' => 'SmartChat: Your Intelligent Customer Support Assistant',
                    'link' => 'https://github.com/Subhadip023/Chatbots-and-Virtual-Assistants/tree/main',
                    'points' => [
                        '"SmartChat" is an intelligent customer support assistant powered by advanced machine learning technologies. This web application revolutionizes user interactions by seamlessly handling inquiries and providing instant, accurate responses. Users can ask questions related to orders, account management, and various services. SmartChat processes user input using a Universal Sentence Encoder, predicts intent through a trained machine learning model, and delivers personalized responses. With a user-friendly interface, it simplifies complex queries, enhancing customer satisfaction. Whether it\'s tracking orders, resolving complaints, or guiding users, SmartChat ensures efficient and effective communication. Experience proactive customer service with SmartChat, your reliable virtual assistant, available 24/7.'
                    ]
                ]
            ],
            'skills' => [
                [
                    'category' => 'Programming Languages',
                    'list' => 'Python, JavaScript (Node.js)'
                ],
                [
                    'category' => 'Web Development',
                    'list' => 'Flask, HTML, CSS (Bootstrap, Tailwind CSS), JavaScript (Node.js with Express.js)'
                ],
                [
                    'category' => 'Frontend Frameworks',
                    'list' => 'Bootstrap, Tailwind CSS'
                ],
                [
                    'category' => 'Backend Frameworks',
                    'list' => 'Node.js, Express.js'
                ],
                [
                    'category' => 'Machine Learning Frameworks',
                    'list' => 'scikit-learn, TensorFlow, TensorFlow Hub'
                ],
                [
                    'category' => 'Tools and Libraries',
                    'list' => 'Git, Jupyter Notebooks, Pandas, NumPy'
                ],
                [
                    'category' => 'Natural Language Processing (NLP)',
                    'list' => 'NLTK, spaCy, Universal Sentence Encoder'
                ],
                [
                    'category' => 'Database',
                    'list' => 'SQL, SQLite'
                ],
                [
                    'category' => 'Version Control',
                    'list' => 'Git, GitHub'
                ],
                [
                    'category' => 'Software',
                    'list' => 'Microsoft Office Suite, Visual Studio Code'
                ],
                [
                    'category' => 'Communication',
                    'list' => 'Strong verbal and written communication skills, effective in explaining complex technical concepts to non-technical stakeholders'
                ]
            ]
        ]);
    }
}
