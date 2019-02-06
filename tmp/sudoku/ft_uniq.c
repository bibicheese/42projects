/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_uniq.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: lucmarti <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/12 11:53:22 by lucmarti          #+#    #+#             */
/*   Updated: 2018/08/12 12:24:08 by lucmarti         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_func.h"

int	ft_uniq(char **sudoku)
{
	int		x;
	int		y;

	y = 0;
	while (y < 9)
	{
		x = 0;
		while (x < 9)
		{
			if (sudoku[x][y] != 0)
			{
				sudoku[x][y]++;
				if (ft_is_valid(sudoku, x, y, sudoku[x][y] - 1) == 0)
					return (0);
				sudoku[x][y]--;
			}
			x++;
		}
		y++;
	}
	return (1);
}
