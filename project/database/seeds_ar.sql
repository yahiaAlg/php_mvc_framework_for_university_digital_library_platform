-- سكريبت زراعة قاعدة البيانات - مبني على صفحة التصفح HTML
-- إدراج بيانات نموذجية تتطابق مع البطاقات المعروضة
USE digital_library;

-- مسح البيانات النموذجية الموجودة (باستثناء المدير)
DELETE FROM project_categories WHERE project_id > 0;
DELETE FROM projects WHERE id > 0;
DELETE FROM users WHERE username != 'admin';

-- إعادة تعيين الزيادة التلقائية
ALTER TABLE projects AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 2;

-- إدراج التخصصات أولاً
INSERT IGNORE INTO specializations (id, name, faculty, description) VALUES
(1, 'علوم الحاسوب', 'كلية الهندسة', 'تطوير البرمجيات والخوارزميات والنظريات الحاسوبية'),
(2, 'نظم المعلومات', 'كلية الهندسة', 'نظم المعلومات التجارية وإدارة البيانات'),
(3, 'هندسة البرمجيات', 'كلية الهندسة', 'تصميم البرمجيات ومنهجيات التطوير وإدارة المشاريع'),
(4, 'شبكات الحاسوب', 'كلية الهندسة', 'البنية التحتية للشبكات والأمان والأنظمة الموزعة'),
(5, 'الذكاء الاصطناعي', 'كلية الهندسة', 'التعلم الآلي والشبكات العصبية والأنظمة الذكية'),
(6, 'الأمن السيبراني', 'كلية الهندسة', 'أمن المعلومات والتشفير وإدارة المخاطر'),
(7, 'علم البيانات', 'كلية الهندسة', 'تحليلات البيانات الضخمة والنمذجة الإحصائية وتصور البيانات'),
(8, 'تطوير التطبيقات المحمولة', 'كلية الهندسة', 'تطوير تطبيقات iOS و Android'),
(9, 'تطوير الويب', 'كلية الهندسة', 'تطبيقات الويب الشاملة والأطر الحديثة'),
(10, 'أنظمة قواعد البيانات', 'كلية الهندسة', 'تصميم قواعد البيانات والتحسين والإدارة'),
(11, 'المعلوماتية الطبية', 'كلية الطب', 'التكنولوجيا الصحية وأنظمة البيانات الطبية'),
(12, 'الهندسة الكهربائية', 'كلية الهندسة', 'تصميم الأجهزة والأنظمة المدمجة'),
(13, 'الواقع المعزز', 'كلية الهندسة', 'تقنية AR/VR والتطبيقات الغامرة'),
(14, 'الحوسبة عالية الأداء', 'كلية الهندسة', 'الحوسبة المتوازية وأنظمة المجموعات'),
(15, 'هندسة الأجهزة', 'كلية الهندسة', 'FPGA وتسريع الأجهزة');

-- إدراج الفئات إذا لم تكن موجودة
INSERT IGNORE INTO categories (id, name, description) VALUES
(1, 'تطبيق ويب', 'مشاريع تتضمن تطبيقات قائمة على الويب'),
(2, 'تطبيق محمول', 'مشاريع لمنصات الهاتف المحمول (iOS, Android)'),
(3, 'التعلم الآلي', 'مشاريع تستخدم خوارزميات وتقنيات ML'),
(4, 'تحليل البيانات', 'مشاريع تركز على معالجة وتحليل البيانات'),
(5, 'الأمان', 'مشاريع متعلقة بالأمن السيبراني وأمن المعلومات'),
(6, 'الشبكات', 'مشاريع تتضمن شبكات الحاسوب والبروتوكولات'),
(7, 'قاعدة البيانات', 'مشاريع تركز على تصميم وإدارة قواعد البيانات'),
(8, 'خوارزمية', 'مشاريع تتضمن حلول خوارزمية والتحسين'),
(9, 'واجهة المستخدم', 'مشاريع تؤكد على تصميم وتطوير UI/UX'),
(10, 'البحث', 'البحث النظري والدراسات الأكاديمية'),
(11, 'الرعاية الصحية', 'مشاريع طبية ومتعلقة بالرعاية الصحية'),
(12, 'التعليم', 'التكنولوجيا التعليمية ومشاريع التعلم الإلكتروني'),
(13, 'البلوك تشين', 'مشاريع السجل الموزع والعملة المشفرة'),
(14, 'إنترنت الأشياء', 'إنترنت الأشياء والأنظمة المدمجة'),
(15, 'AR/VR', 'تطبيقات الواقع المعزز والافتراضي');

-- إدراج المستخدمين الطلاب النموذجيين بناءً على المؤلفين في HTML
INSERT INTO users (username, email, password_hash, full_name, specialization_id, role) VALUES
('sarah.johnson', 'sarah.johnson@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'سارة جونسون', 5, 'student'),
('ahmed.alhassan', 'ahmed.alhassan@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'أحمد الحسن', 3, 'student'),
('maria.rodriguez', 'maria.rodriguez@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ماريا رودريجيز', 6, 'student'),
('david.thompson', 'david.thompson@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ديفيد تومسون', 3, 'student'),
('elena.petrov', 'elena.petrov@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'د. إيلينا بيتروف', 11, 'student'),
('fatima.alzahra', 'fatima.alzahra@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'فاطمة الزهراء', 5, 'student'),
('kevin.zhang', 'kevin.zhang@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'كيفين تشانغ', 5, 'student'),
('isabella.santos', 'isabella.santos@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'إيزابيلا سانتوس', 7, 'student'),
('omar.hassan', 'omar.hassan@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'عمر حسان', 6, 'student'),
('anna.kowalski', 'anna.kowalski@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'آنا كوالسكي', 6, 'student'),
('lucas.silva', 'lucas.silva@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'لوكاس سيلفا', 6, 'student'),
('raj.patel', 'raj.patel@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'راج باتيل', 4, 'student'),
('sophie.martin', 'sophie.martin@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'صوفي مارتن', 11, 'student'),
('yuki.tanaka', 'yuki.tanaka@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'يوكي تاناكا', 8, 'student'),
('carlos.mendez', 'carlos.mendez@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'كارلوس منديز', 9, 'student'),
('priya.sharma', 'priya.sharma@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'برييا شارما', 15, 'student'),
('michael.oconnor', 'michael.oconnor@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'مايكل أوكونور', 12, 'student'),
('lei.wang', 'lei.wang@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'لي وانغ', 7, 'student'),
('jennifer.kim', 'jennifer.kim@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'جينيفر كيم', 1, 'student'),
('alessandro.rossi', 'alessandro.rossi@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'أليساندرو روسي', 12, 'student');

-- إدراج المشاريع كما هي موضحة في بطاقات HTML
INSERT INTO projects (title, description, author_name, supervisor, specialization_id, user_id, image_path, file_path, year, keywords, status) VALUES
-- البطاقة 1
('نظام إدارة التعلم الإلكتروني المتقدم مع دمج الذكاء الاصطناعي', 'نظام تعلم إلكتروني ذكي يستخدم التعلم الآلي لتجارب التعلم الشخصية، وتقييم المحتوى التلقائي، ومسارات التعلم التكيفية القائمة على أداء الطلاب.', 'سارة جونسون', 'د. مايكل ستيفنز', 5, 2, '/images/card1-img.png', 'https://www.africau.edu/images/default/sample.pdf', 2024, 'AI, e-learning, machine learning, education, personalization', 'approved'),

-- البطاقة 2
('معمارية الخدمات المصغرة لتخطيط موارد المؤسسات', 'تطوير نظام ERP قابل للتوسع ومبني على الخدمات المصغرة للمؤسسات المتوسطة والكبيرة، مع التركيز على الحاويات وتنظيم الخدمات والمعمارية المدفوعة بالأحداث للحصول على توفر عالي وتحمل الأخطاء.', 'أحمد الحسن', 'بروف. سارة ميتشل', 3, 3, '/images/card2-img.png', 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 2023, 'microservices, ERP, containerization, scalability, enterprise', 'approved'),

-- البطاقة 3
('نظام التحقق من الهوية الرقمية القائم على البلوك تشين', 'نظام التحقق من الهوية الرقمية اللامركزي باستخدام البلوك تشين، يعالج مخاوف الخصوصية بالبراهين التشفيرية والعقود الذكية للأمان والأصالة.', 'ماريا رودريجيز', 'د. روبرت تشين', 6, 4, '/images/card3-img.png', 'https://www.learningcontainer.com/wp-content/uploads/2019/09/sample-pdf-file.pdf', 2024, 'blockchain, digital identity, security, cryptography, decentralization', 'approved'),

-- البطاقة 4
('محرر الكود التعاوني في الوقت الفعلي مع التحكم في الإصدار', 'محرر كود تعاوني قائم على الويب مع التحرير متعدد المستخدمين في الوقت الفعلي، والتحكم في الإصدار، وإبراز الصيغة، والإكمال التلقائي، وحل التعارضات.', 'ديفيد تومسون', 'بروف. ليزا أندرسون', 3, 5, '/images/card4-img.png', 'https://www.clickdimensions.com/links/TestPDFfile.pdf', 2023, 'real-time collaboration, code editor, version control, web application', 'approved'),

-- البطاقة 5
('نموذج التعلم العميق لتشخيص الصور الطبية', 'شبكة عصبية التفافية لتشخيص سرطان الجلد من صور الأمراض الجلدية، تحقق دقة 94.2% مع تحديد الشكوك للدعم السريري.', 'د. إيلينا بيتروف', 'بروف. مايكل تشانغ', 11, 6, '/images/card5-img.png', 'https://www.adobe.com/support/products/enterprise/knowledgecenter/media/c4611_sample_explain.pdf', 2024, 'deep learning, medical imaging, CNN, cancer diagnosis, healthcare', 'approved'),

-- البطاقة 6
('معالجة اللغة الطبيعية لتحليل المشاعر في وسائل التواصل الاجتماعي', 'استكشاف تقنيات معالجة اللغة الطبيعية المتقدمة لتحليل مشاعر وسائل التواصل الاجتماعي متعددة اللغات باستخدام نموذج قائم على المحولات يتعامل مع التبديل بين الأكواد والسياق الثقافي.', 'فاطمة الزهراء', 'د. جينيفر بارك', 5, 7, '/images/card6-img.png', 'https://file-examples.com/storage/fe68c8c7ccf21b9e2af1a18/2017/10/file_example_PDF_1MB.pdf', 2023, 'NLP, sentiment analysis, social media, transformers, multilingual', 'approved'),

-- البطاقة 7
('التعلم التعزيزي لملاحة المركبات المستقلة', 'تنفيذ خوارزمية التعلم التعزيزي لملاحة المركبات المستقلة باستخدام التعلم العميق Q، مدربة في بيئة حضرية محاكاة مع عوائق ديناميكية وأنماط حركة المرور.', 'كيفين تشانغ', 'بروف. أليكس رودريجيز', 5, 8, '/images/card7-img.png', 'https://scholar.harvard.edu/files/torman_personal/files/samplepdf.pdf', 2024, 'reinforcement learning, autonomous vehicles, deep Q-learning, simulation', 'approved'),

-- البطاقة 8
('التحليلات التنبؤية لتحسين سلسلة التوريد', 'تطبيق التعلم الآلي للتنبؤ بالطلب وتحسين مخزون سلسلة التوريد العالمية باستخدام التنبؤ بالسلاسل الزمنية والتحسين متعدد الأهداف لخفض التكلفة وتحسين الخدمة.', 'إيزابيلا سانتوس', 'د. كيفين وو', 7, 9, '/images/card8-img.png', 'https://www.orimi.com/pdf-test.pdf', 2023, 'predictive analytics, supply chain, machine learning, optimization', 'approved'),

-- البطاقة 9
('نظام كشف التسلل المتقدم باستخدام التعلم الآلي', 'نظام كشف تسلل ذكي يجمع بين الطرق القائمة على التوقيع والشذوذ باستخدام التعلم الآلي المجمع لتحسين كشف هجمات اليوم الصفر وتقليل الإيجابيات الكاذبة.', 'عمر حسان', 'بروف. ماريا غونزاليز', 6, 10, '/images/card9-img.png', 'https://www.antennahouse.com/hubfs/xsl-fo-sample/pdf/basic-link-1.pdf', 2024, 'intrusion detection, machine learning, cybersecurity, anomaly detection', 'approved'),

-- البطاقة 10
('بروتوكول الاتصال الآمن القائم على البلوك تشين', 'بروتوكول اتصال آمن قائم على البلوك تشين للمراسلة المشفرة من النهاية إلى النهاية، يضمن السلامة والمصادقة وعدم الإنكار واللامركزية والقابلية للتوسع.', 'آنا كوالسكي', 'بروف. توماس كيم', 6, 11, '/images/card10-img.png', 'https://www.guwahati.ac.in/web/uploads/about/history/sample.pdf', 2023, 'blockchain, secure communication, encryption, messaging, protocol', 'approved'),

-- البطاقة 11
('إطار تقييم الثغرات لأجهزة إنترنت الأشياء', 'إطار تقييم ثغرات تلقائي لأجهزة إنترنت الأشياء، يتضمن التحليل الثابت والديناميكي، والهندسة العكسية للبرامج الثابتة، والتقارير الشاملة.', 'لوكاس سيلفا', 'بروف. أماندا فوستر', 6, 12, '/images/card11-img.png', 'https://www.soundczech.cz/temp/lorem-ipsum.pdf', 2024, 'IoT security, vulnerability assessment, firmware analysis, cybersecurity', 'approved'),

-- البطاقة 12
('معمارية أمان الشبكة المعرفة بالبرمجيات', 'إطار أمان SDN قابل للتوسع يدمج جدران الحماية الموزعة والمراقبة في الوقت الفعلي والاستجابة التلقائية للتهديدات لتحسين الأداء والمرونة.', 'راج باتيل', 'د. ريتشارد براون', 4, 13, '/images/card12-img.png', 'https://www.tutorialspoint.com/mongodb/mongodb_tutorial.pdf', 2023, 'SDN, network security, distributed systems, threat response', 'approved'),

-- البطاقة 13
('تطبيق ويب تقدمي لإدارة الرعاية الصحية', 'تطبيق PWA متوافق مع HIPAA للرعاية الصحية، يوفر الوصول دون اتصال، والمزامنة في الوقت الفعلي، وسجلات المرضى، وجدولة المواعيد، والطب عن بُعد.', 'صوفي مارتن', 'بروف. كاثرين لي', 11, 14, '/images/card13-img.png', 'https://filesamples.com/samples/document/pdf/sample3.pdf', 2024, 'PWA, healthcare, HIPAA compliance, telemedicine, patient management', 'approved'),

-- البطاقة 14
('تطبيق محمول متعدد المنصات لتعلم اللغات', 'تطبيق تعلم لغات متعدد المنصات مع التلعيب، والتكرار المتباعد، والميزات الاجتماعية، والوصول دون اتصال، والتعلم التكيفي للتقدم الشخصي.', 'يوكي تاناكا', 'د. ستيفن يانغ', 8, 15, '/images/card14-img.png', 'https://www.adobe.com/content/dam/acom/en/devnet/acrobat/pdfs/pdf_open_parameters.pdf', 2023, 'mobile development, language learning, gamification, cross-platform', 'approved'),

-- البطاقة 15
('منصة التجارة الإلكترونية مع معمارية الخدمات المصغرة', 'منصة التجارة الإلكترونية القابلة للتوسع المبنية على الخدمات المصغرة والحاويات، تتضمن إدارة المستخدمين وكتالوج المنتجات ومعالجة الطلبات والمدفوعات والمخزون في الوقت الفعلي ومحرك التوصيات.', 'كارلوس منديز', 'بروف. نانسي ويلسون', 9, 16, '/images/card15-img.png', 'https://www.irs.gov/pub/irs-pdf/fw4.pdf', 2024, 'e-commerce, microservices, containerization, recommendation engine', 'approved'),

-- البطاقة 16
('تطبيق الواقع المعزز المحمول للتعليم', 'تطبيق AR محمول للتعليم العلمي التفاعلي، يستخدم رؤية الحاسوب والعرض ثلاثي الأبعاد لإضافة محتوى رقمي على الكائنات الحقيقية، مما يعزز المشاركة في الفيزياء والكيمياء.', 'برييا شارما', 'د. دانيال مارتينيز', 15, 17, '/images/card16-img.png', 'https://www.ssa.gov/forms/ss-5.pdf', 2023, 'augmented reality, education, mobile app, computer vision, science', 'approved'),

-- البطاقة 17
('نظام التشغيل في الوقت الفعلي للأجهزة المدمجة لإنترنت الأشياء', 'RTOS خفيف الوزن لأجهزة إنترنت الأشياء، محسن لجدولة المهام في الوقت الفعلي وإدارة الذاكرة الفعالة وتوفير الطاقة في الأنظمة المدمجة التي تعمل بالبطارية.', 'مايكل أوكونور', 'بروف. راشيل غرين', 12, 18, '/images/card17-img.png', 'https://www.cms.gov/Medicare/CMS-Forms/CMS-Forms/Downloads/CMS40B.pdf', 2024, 'RTOS, embedded systems, IoT, real-time scheduling, power optimization', 'approved'),

-- البطاقة 18
('إطار الحوسبة الموزعة لمعالجة البيانات الضخمة', 'إطار حوسبة موزع للبيانات الضخمة، يحسن محلية البيانات وتحمل الأخطاء مع توازن الحمل التكيفي والاسترداد التلقائي لتعزيز الموثوقية.', 'لي وانغ', 'د. مارك جونسون', 7, 19, '/images/card18-img.png', 'https://www.fda.gov/media/99792/download', 2023, 'distributed computing, big data, fault tolerance, load balancing', 'approved'),

-- البطاقة 19
('نظام إدارة مجموعة الحوسبة عالية الأداء', 'نظام إدارة مجموعة الحوسبة عالية الأداء يتضمن جدولة الوظائف وتخصيص الموارد والمراقبة وتحسين الأداء، مع دعم للأجهزة المتنوعة والصيانة التنبؤية.', 'جينيفر كيم', 'بروف. لورا ديفيس', 1, 20, '/images/card19-img.png', 'https://www.census.gov/content/dam/Census/library/publications/2020/demo/p60-270.pdf', 2024, 'HPC, cluster management, job scheduling, performance optimization', 'approved'),

-- البطاقة 20
('مسرع قائم على FPGA لاستدلال التعلم الآلي', 'مسرع أجهزة قائم على FPGA للذكاء الاصطناعي الطرفي، يقدم استدلال الشبكات العصبية العميقة عالي الأداء مع استهلاك طاقة منخفض، متفوقاً على حلول CPU/GPU.', 'أليساندرو روسي', 'بروف. بيتر تشانغ', 12, 21, '/images/card20-img.png', 'https://www.energy.gov/sites/prod/files/2019/01/f58/Ultimate%20Guide%20to%20Federal%20Energy%20Management.pdf', 2023, 'FPGA, machine learning, hardware acceleration, edge AI, neural networks', 'approved');

-- إدراج علاقات فئات المشاريع
INSERT INTO project_categories (project_id, category_id) VALUES
-- البطاقة 1: نظام التعلم الإلكتروني بالذكاء الاصطناعي
(1, 3), (1, 12), (1, 1),
-- البطاقة 2: الخدمات المصغرة ERP
(2, 1), (2, 7),
-- البطاقة 3: الهوية بالبلوك تشين
(3, 13), (3, 5),
-- البطاقة 4: محرر الكود
(4, 1), (4, 9),
-- البطاقة 5: تشخيص الصور الطبية
(5, 3), (5, 11), (5, 10),
-- البطاقة 6: تحليل المشاعر NLP
(6, 3), (6, 4), (6, 10),
-- البطاقة 7: المركبات المستقلة RL
(7, 3), (7, 8),
-- البطاقة 8: تحليلات سلسلة التوريد
(8, 4), (8, 3),
-- البطاقة 9: كشف التسلل
(9, 5), (9, 3),
-- البطاقة 10: اتصال البلوك تشين
(10, 13), (10, 5),
-- البطاقة 11: تقييم ثغرات إنترنت الأشياء
(11, 14), (11, 5),
-- البطاقة 12: أمان SDN
(12, 6), (12, 5),
-- البطاقة 13: PWA الرعاية الصحية
(13, 1), (13, 11),
-- البطاقة 14: تطبيق تعلم اللغات
(14, 2), (14, 12),
-- البطاقة 15: منصة التجارة الإلكترونية
(15, 1), (15, 2),
-- البطاقة 16: تطبيق التعليم AR
(16, 15), (16, 12), (16, 2),
-- البطاقة 17: RTOS لإنترنت الأشياء
(17, 14), (17, 8),
-- البطاقة 18: إطار البيانات الضخمة
(18, 4), (18, 8),
-- البطاقة 19: إدارة مجموعة HPC
(19, 1), (19, 8),
-- البطاقة 20: مسرع FPGA ML
(20, 3), (20, 8);

-- تحديث الطوابع الزمنية للتنوع
UPDATE users SET created_at = DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 365) DAY) WHERE id > 1;
UPDATE projects SET created_at = DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 200) DAY);

-- إضافة بعض المشاريع المعلقة للواقعية
UPDATE projects SET status = 'pending' WHERE id IN (6, 10, 14);

COMMIT;