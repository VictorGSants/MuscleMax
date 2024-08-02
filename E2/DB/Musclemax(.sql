-- Criação do banco de dados

-- Uso do banco de dados
USE musclemax;

-- Criação das tabelas
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(100) NOT NULL,
    sexo ENUM('Masculino', 'Feminino', 'Outro') 
);

CREATE TABLE Exercises (
    ExerciseID INT PRIMARY KEY AUTO_INCREMENT,
    ExerciseName VARCHAR(100) NOT NULL,
    Description TEXT,
    MuscleGroup VARCHAR(50)
);

CREATE TABLE Workouts (
    WorkoutID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    WorkoutName VARCHAR(100) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE ExercisesInWorkout (
    ExerciseInWorkoutID INT PRIMARY KEY AUTO_INCREMENT,
    WorkoutID INT,
    ExerciseID INT,
    Sets INT,
    Reps INT,
    Weight DECIMAL(10,2),
    RestTimeSeconds INT,
    FOREIGN KEY (WorkoutID) REFERENCES Workouts(WorkoutID),
    FOREIGN KEY (ExerciseID) REFERENCES Exercises(ExerciseID)
);

CREATE TABLE ExerciseRecords (
    RecordID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ExerciseName char(40) ,
    Weight DECIMAL(10,2),
    DateRecorded DATE,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);
