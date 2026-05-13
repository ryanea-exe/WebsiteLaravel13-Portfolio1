CREATE TABLE abouts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    home_id INTEGER,
    banner_id INTEGER,
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    description TEXT,
    summary TEXT,
    tagline VARCHAR(255),
    cv VARCHAR(255), -- Biasanya berisi path/link file CV
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
