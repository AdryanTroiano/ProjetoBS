import express from "express";
import cors from "cors";
import dotenv from "dotenv";

import routes from "./routes";
import { hostname } from "node:os";

dotenv.config();
const port = process.env.PORT ;
const app = express();

app.use(cors());
app.use(express.json());

app.use(routes);

app.listen( port, "0.0.0.0", () => {
  console.log(`Servidor rodando na porta ${port}`);
});