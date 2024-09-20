"use client"

import { useState, type FunctionComponent } from "react"
import type { BookItemProps } from "./BookItem.interface"
import {
  Card,
  CardContent,
  CardMedia,
  CardActions,
  Button,
  Typography,
  Tooltip,
} from "@mui/material"
import { createLoan } from "@/api/loan"

export const BookItem: FunctionComponent<BookItemProps> = ({
  id,
  title,
  coverUrl,
}) => {
  const handleLoan = async () => {
    setIsLoading(true)
    try {
      const data = await createLoan(id)
      setActivateLoan(true)
    } catch (error) {
      console.error("Error creating loan:", error)
    } finally {
      setIsLoading(false)
    }
  }
  return (
    <Card variant="outlined">
      <CardMedia
        sx={{ height: 264 }}
        image={coverUrl ? coverUrl : "/cover.png"}
        title={title}
      />
      <CardContent>
        <Tooltip title={title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non
          arcu...
        </Typography>
      </CardContent>
      <CardActions>
        <Button
          size="small"
          variant="contained"
          fullWidth
          onClick={handleLoan}
          disabled={activateLoan}
        >
          {isLoading
            ? "Processando..."
            : activateLoan
            ? "Empréstimo ativo"
            : "Empréstimo"}
        </Button>
      </CardActions>
    </Card>
  )
}
