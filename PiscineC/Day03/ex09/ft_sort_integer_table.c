/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_sort_integer_table.c                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/07 01:55:20 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/08 02:03:32 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

void	ft_sort_integer_table(int *tab, int size)
{
	int i;
	int n;
	int stock;

	i = 0;
	while (i < size)
	{
		n = i + 1;
		while (n < size)
		{
			if (tab[i] > tab[n])
			{
				stock = tab[i];
				tab[i] = tab[n];
				tab[n] = stock;
			}
			n++;
		}
		i++;
	}
}
